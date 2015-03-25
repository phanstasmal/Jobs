<?php

class JobController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::get('j')){
			$linkJob = Input::get('j');
			$curl = curl_init();
			curl_setopt_array($curl,array(
				CURLOPT_URL => $linkJob,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36',
				CURLOPT_POSTFIELDS=> "",
				CURLOPT_HEADER => 0,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST=> 0
			));
			$reps = curl_exec($curl);
			curl_close($curl);

			// Parse markdown in json
			$objJob = json_decode($reps);
			$markdownParser = new \dflydev\markdown\MarkdownParser();
			$objJob->body = $markdownParser->transformMarkdown($objJob->body);
		}
		return View::make('app.job.index')
			-> with('job',$objJob);
	}

}
