<?php
namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Services\CampaignsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CampaignsController extends Controller {
    public function __construct(CampaignsService $campaignsService){
        $this->campaignsService = $campaignsService;
    }

    public function getCamps(Request $request){
        $data = $this->campaignsService->getCamps($request->all());
        return Response::json($data, 200);
    }

    public function putLP(Request $request){
        $data = $this->campaignsService->putLP($request->all());
        return Response::json($data, 200);
    }
}