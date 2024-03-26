<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class FeedController extends Controller {
    public function processFeed(Request $request) {
        $request->validate([
            'url' => 'required|url',
        ]);

        $today = today()->format('d-m');
        $episodes = [];

        $xml = simplexml_load_file($request->url);
        $i = 0;
        while(isset($xml?->channel?->item[$i])) {
            $episode = $xml->channel->item[$i];

            if (property_exists($episode, 'pubDate')) {
                $published = Carbon::parse($episode->pubDate);
                if ($published->format('d-m') == $today) {
                    $episodes[] = $episode;
                }
            }

            $i++;
        }

        return ['success' => count($episodes) > 0, 'episodes' => $episodes];
    }
}
