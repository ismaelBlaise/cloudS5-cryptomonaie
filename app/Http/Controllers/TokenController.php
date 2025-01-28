<?php
/**
 * @OA\Info(
 *     title="API Token Management",
 *     version="1.0.0",
 *     description="API pour la gestion et la validation des tokens d'authentification.",
 *     @OA\Contact(
 *         email="support@votreapp.com"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Token",
 *     description="Opérations liées à la validation des tokens d'authentification"
 * )
 */

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

/**
 * @OA\PathItem(
 *     path="/token"
 * )
 */

/**
 * @OA\Server(
 *     url="https://api.votreapp.com",
 *     description="API principale"
 * )
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TokenService;  

/**
 * @OA\Tag(name="Token")
 * 
 * @OA\Schema(
 *     schema="TokenController",
 *     type="object",
 *     description="Contrôleur pour gérer la validation des tokens",
 *     properties={
 *         @OA\Property(
 *             property="tokenService",
 *             type="object",
 *             description="Service de gestion des tokens"
 *         )
 *     }
 * )
 */
class TokenController extends Controller
{
    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * TokenController constructor.
     *
     * @param TokenService $tokenService
     */
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Valider un token d'authentification.
     *
     * Cette méthode permet de valider un token envoyé par l'utilisateur pour s'assurer qu'il est toujours valide.
     *
     * @OA\Get(
     *     path="/valider-token",
     *     summary="Valider un token",
     *     description="Permet de valider un token envoyé pour vérifier son authenticité.",
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", example="exampleToken12345")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Token valide",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Token valide.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token expiré",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Token expiré. Veuillez vous reconnecter.")
     *         )
     *     )
     * )
     */
    public function validerToken(Request $request)
    {
        $token = $request->query('token');   

        if ($this->tokenService->isTokenValid($token)) {
            return response()->json(['message' => 'Token valide.'], 200);
        } else {
            return response()->json(['message' => 'Token expiré. Veuillez vous reconnecter.'], 401);
        }
    }
}
