<?php

namespace App\Http\Controllers\V1\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Repository\Investor\ChatRepository;
use App\Repository\Investor\RateRepository;
use App\Models\Profile;
use App\Models\Trader;
use Monarobase\CountryList\CountryListFacade;


class TraderController extends Controller
{
    public function index()
    {
        $countries = CountryListFacade::getList('en');
        $traders = Trader::inRandomOrder()->paginate(6);

        $data = [
            'name' => '',
            'service_id' => '',
            'nationality' => '',
            'gender' => '',
            'min_rating' => '',
            'max_rating' => '',
            'liquidity' => '',
            'liquidity_amt' => '',
        ];

        return view('v1.investor.traders', compact('traders', 'countries', 'data'));
    }

    
    public function show(Profile $profile)
    {
        return view('v1.investor.show-trader', compact('profile'));
    }


    public function packages(Profile $profile) 
    { 
        if ($profile->profileable_type == "trader") { 
            $packages = $profile->profileable->packages; 
            return view('v1.investor.trader-packages', compact('profile', 'packages')); 
        } 
    } 

    public function chat($profile)
    {
        if ($profile) {

            $conversation = Conversation::where([
                                                ['sender_id', auth()->user()->id],
                                                ['reciever_id', $profile]
                                            ])
                                        ->orWhere([
                                                ['sender_id', $profile],
                                                ['reciever_id', auth()->user()->id],
                                            ])
                                        ->first();
        
            if (!$conversation) {
                $ChatRepository = new ChatRepository;
                $conversation = $ChatRepository->newChat($profile);
            }

            return redirect()->route('investor.chat.conversation', ['conversation' => $conversation]);
        }

    }


    public function search(Request $request)
    {
        $traders = Trader::query();


        $name = $request->name;
        $service_id = $request->service_id;
        $nationality = $request->nationality;
        $gender = $request->gender;
        $min_rating = $request->min_rating;
        $max_rating = $request->max_rating;
        $liquidity = $request->liquidity;
        $liquidity_amt = $request->liquidity_amt;


        
        if ($name) {
            $traders->where('firstname','LIKE','%'.$name.'%')
                    ->orWhere('lastname','LIKE','%'.$name.'%');
        }

        if ($nationality) {
            $traders->orWhere('nationality','LIKE','%'.$nationality.'%');
        }
        
        if ($gender) {
            $traders->where('gender','LIKE','%'.$gender.'%');
        }

        // if ($min_rating) {
        //     $traders->where('admin_rating', '>=', (int)$min_rating);
        // }

        // if ($max_rating) {
        //     $traders->where('admin_rating', '<=', (int)$max_rating);
        // }
        
        if ($liquidity) {
            $traders->where('liquidity','LIKE','%'.$liquidity.'%');
        }

        if ($liquidity_amt) {
            $traders->where('liquidity_amt', '<=', (int)$liquidity_amt);
        }


        $data = [
            'name' => $name,
            'service_id' => $service_id,
            'nationality' => $nationality,
            'gender' => $gender,
            'min_rating' => $min_rating,
            'max_rating' => $max_rating,
            'liquidity' => $liquidity,
            'liquidity_amt' => $liquidity_amt,
        ];

        $traders = $traders->paginate(6);
        $countries = CountryListFacade::getList('en');

        return view('v1.investor.traders', compact('traders', 'data', 'countries'));
    }


    public function rate(Request $request)
    {
        $request->validate([
            'trader_id' => 'required',
            'investor_id' => 'required',
            'rating' => 'required|numeric',
        ]);

        $rateRepository = new RateRepository;
        $rate = $rateRepository->store($request->all());

        if($rate) {
            return back()->with('success', 'You have rated this trader.');
        } else {
            return back();
        }
    }
}
