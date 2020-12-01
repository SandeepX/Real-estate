<?php

namespace App\Repository\Api\V1;

use Illuminate\Http\Request;
use App\AboutUs;
use App\ContactMessage;
use App\Faq;
use App\Http\Resources\AboutUsResource;
use App\Http\Resources\Collection\FaqCollection;
use App\Http\Resources\Collection\TermConditionCollection;
use App\Http\Resources\TermConditionResource;
use App\PrivacyPolicy;
use App\TermCondition;

class SiteHelperRepository
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Gets all address
     *
     * @return AboutUsResource
     */
    public function getAboutUs()
    {
        $aboutus = AboutUs::find(1);
        return new AboutUsResource($aboutus);
    }

    /**
     * Gets terms and conditions
     *
     * @return TermConditionCollection
     */
    public function getTermsAndConditions()
    {
        return new TermConditionCollection(TermCondition::all());
    }

    /**
     * Gets privacy policy
     *
     * @return TermConditionCollection
     */
    public function getPrivacyPolicy()
    {
        return new TermConditionCollection(PrivacyPolicy::all());
    }

    /**
     * Saves user contact queries
     *
     * @return JSON_RESPONSE
     */
    public function contactUs()
    {
        $contact          = new ContactMessage;
        $contact->name    = $this->request->name;
        $contact->email   = $this->request->email;
        $contact->subject = $this->request->subject;
        $contact->phone   = $this->request->phone;
        $contact->message = $this->request->message;
        $contact->save();
        return sendResponse("We have received your details and will contact you as soon as possible.");
    }

    /**
     * Gets faqs
     *
     * @return TermConditionCollection
     */
    public function getFaqs()
    {
        return new FaqCollection(Faq::all());
    }
}
