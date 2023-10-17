<?php

namespace App\Helpers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Connector
{
    public string $api_link = 'https://symfony-skeleton.q-tests.com/api/v2/';

    /**
     * @param string $method
     * @param string $path
     * @param array|string|null $data
     * @return JsonResponse|string
     */
    public function connect(
        string $method,
        string $path,
        array|string|null $data = null
    ): JsonResponse|array|string
    {
        $url = $this->api_link . $path;

        try {
            if (! Cache::has('access_token')) {
                $this->getToken();
            }

            $request = Http::withToken(Cache::get('access_token'))->retry(1, 100)->withoutRedirecting()->acceptJson();

            $response = $request->$method($url, $data);

            if ($response->status() === JsonResponse::HTTP_UNAUTHORIZED) {
                throw new RequestException($response);
            }

            if ($response->status() !== JsonResponse::HTTP_OK) {
                throw new \Exception();
            }
        } catch (RequestException $e) {
            $this->getToken(true);

            $response = $request->withToken(Cache::get('access_token'))->retry(3, 100)->acceptJson()->$method($url, $data);
        } catch (\Exception $e) {
            error_log("URL: " . $url . PHP_EOL);
            error_log("HTTP code: " . $response->getStatusCode() . PHP_EOL);
            error_log("Response body: " . $response->getBody()->getContents() . PHP_EOL);

            return response()->json([
                'message' => 'Could not connect to API'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return $response->json();
    }

    /**
     * @param bool $refresh
     * @param array|null $data
     * @return JsonResponse|string
     */
    public function getToken(bool $refresh = false, array|null $data = null): JsonResponse|string
    {
        $method = 'post';
        $url = $this->api_link . 'token';
        if ($refresh) {
            $method = 'get';
            $url .= '/refresh/' . Cache::get('refresh_token');
        }

        $response = Http::asJson()->acceptJson()->$method($url, $data);

        if ($response->status() !== JsonResponse::HTTP_OK) {
            return response()->json([
                'message' => $response->getBody()->getContents()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $token = $response->json('token_key');
        $refreshToken = $response->json('refresh_token_key');

        if (! Cache::add('access_token', $token)) {
            Cache::put('access_token', $token);
        }

        if (! Cache::add('refresh_token', $refreshToken)) {
            Cache::put('refresh_token', $refreshToken);
        }

        if (!$refresh) {
            Cache::putMany([
                'first_name' => $response->json('user.first_name'),
                'last_name' => $response->json('user.last_name'),
            ]);
        }

        return $token;
    }
}
