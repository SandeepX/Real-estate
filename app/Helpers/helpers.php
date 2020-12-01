<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Send a response back
 *
 * @param  string $message
 * @param  boolean $error
 * @param  integer $code
 * @param  array $parameters
 * @return Illuminate\Http\JsonResponse
 */
function sendResponse($message, $error = false, $code = 200, array $parameters = null)
{
    $response = [
        'error'   => $error,
        'message' => $message,
        'code'    => $code
    ];

    if (!is_null($parameters)) {
        foreach ($parameters as $key => $value) {
            $response = array_add($response, $key, $value);
        }
    }

    return response()->json($response, 200);
}


/**
 * Convert url to proper path
 *
 * @param $path
 * @return string
 */
function photoToUrl($path, $directory_path)
{
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        $photo = $path;
    } else {
        $photo = $path ? url('/') . $directory_path . $path : '';
    }
    return $photo;
}

/**
 * Convert base64 to jpg
 *
 * @param  $base64_string
 * @param $output_path
 * @return String
 */
function base64_to_jpeg($base64_string, $output_path)
{
    $data      = explode(',', $base64_string);
    $imageData = str_replace(' ', '+', end($data));
    $source    = base64_decode($imageData);
    $filename  = generateFilename($output_path, get_extension_from_base64($imageData));
    file_put_contents($output_path . $filename, $source);
    return $filename;
}

/**
 * Get file extension from base64 string
 *
 * @param $base64_string
 * @return mixed
 */
function get_extension_from_base64($base64_string)
{
    $imageData = base64_decode($base64_string);
    $f = finfo_open();

    $mime_type = finfo_buffer($f, $imageData, FILEINFO_MIME_TYPE);
    $extensions = [
        'image/gif'  => 'gif',
        'image/png'  => 'png',
        'image/jpeg' => 'jpg',
        'image/bmp'  => 'bmp',
        'image/webp' => 'webp'
    ];

    return $extensions[$mime_type];
}

/**
 * Generate an unique filename
 *
 * @param  $path
 * @param $extension
 * @return string
 */
function generateFilename($path, $extension)
{
    $filename = substr(hash('sha256', Illuminate\Support\Str::random(), false), 0, 16) . '.' . $extension;
    if (app('files')->exists($path . $filename)) {
        generateFilename($path, $extension);
    }
    return $filename;
}

/**
 * Gera a paginação dos itens de um array ou collection.
 *
 * @param array|Collection      $items
 * @param int   $perPage
 * @param int  $page
 * @param array $options
 *
 * @return LengthAwarePaginator
 */
function paginate($items, $perPage = 15, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}

function androidPushNotification($token, $message, $options)
{
    $client = new GuzzleHttp\Client();

    $title = "Omlotstate";

    $headers = [
        'Authorization' => 'key = ' . config('services.firebase.key'),
        'Content-Type'  => 'application/json'
    ];

    $notification = [
        'title' => $title,
        'body'  => $message,
        'sound' => 'default',
    ];

    $options['title'] = $title;
    $options['body'] = $message;
    $options['sound'] = "default";

    $data = [
        'to'           => $token,
        // 'notification' => $notification,
        'data'         => $options
    ];

    $response = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
        'headers' => $headers,
        'json'    => $data
    ]);

    return $response;
}
