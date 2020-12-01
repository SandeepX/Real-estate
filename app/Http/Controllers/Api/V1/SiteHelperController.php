<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Api\V1\SiteHelperRepository;

class SiteHelperController extends Controller
{
    /**
     * @var SiteHelperRepository
     */
    private $siteHelperRepo;

    public function __construct(SiteHelperRepository $siteHelperRepo)
    {
        $this->siteHelperRepo = $siteHelperRepo;
    }

    /**
     * Gets about us
     *
     * @return JsonResponse
     */
    public function getAboutUs()
    {
        return $this->siteHelperRepo->getAboutUs();
    }

    /**
     * Gets terms and conditions
     *
     * @return JsonResponse
     */
    public function getTermsAndConditions()
    {
        return $this->siteHelperRepo->getTermsAndConditions();
    }

    /**
     * Gets privacy policy
     *
     * @return TermConditionCollection
     */
    public function getPrivacyPolicy()
    {
        return $this->siteHelperRepo->getPrivacyPolicy();
    }

    /**
     * Saves user contact queries
     *
     * @return JSON_RESPONSE
     */
    public function contactUs()
    {
        return $this->siteHelperRepo->contactUs();
    }

    /**
     * Gets faqs
     *
     * @return TermConditionCollection
     */
    public function getFaqs()
    {
        return $this->siteHelperRepo->getFaqs();
    }
}
