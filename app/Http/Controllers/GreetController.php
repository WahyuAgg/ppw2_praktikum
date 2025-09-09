<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



/**
 * @OA\Info(
 *     title="My First API",
 *     version="0.1"
 * )
 */
class GreetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/greet",
     *     tags={"greeting"},
     *     summary="Returns a Sample API response",
     *     description="A sample greeting to test out the API",
     *     operationId="greet",
     *     @OA\Parameter(
     *         name="firstname",
     *         description="First name of the user",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="lastname",
     *         description="Last name of the user",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil memproses masukan user",
     *                 "data": {
     *                     "output": "Halo John Doe",
     *                     "firstname": "John",
     *                     "lastname": "Doe"
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Missing required parameters",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "message": "Missing data"
     *             }
     *         )
     *     )
     * )
     */
    public function greet(Request $request)
    {
        // Ambil data yang hanya ada pada input 'firstname' dan 'lastname'
        $userData = $request->only(['firstname', 'lastname']);

        // Cek apakah 'firstname' dan 'lastname' kosong
        if (empty($userData['firstname']) || empty($userData['lastname'])) {
            // Jika data tidak ada, lemparkan exception dengan response JSON 404
            return response()->json([
                'success' => false,
                'message' => 'Missing data'
            ], 404);
        }

        // Kembalikan response JSON jika data ada
        return response()->json([
            'success' => true,
            'message' => 'Berhasil memproses masukan user',
            'data' => [
                'output' => 'Halo ' . $userData['firstname'] . ' ' . $userData['lastname'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname']
            ]
        ], 200);
    }
}

