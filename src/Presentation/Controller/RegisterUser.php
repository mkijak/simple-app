<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\CommandBus;
use App\Application\Exception\InvalidInput;
use App\Presentation\Exception\InvalidDto;
use App\Presentation\Service\GeneratesJsonResponse;
use App\Presentation\Service\ProvidesApiModels;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use App\Presentation\DTO;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;

class RegisterUser
{
    public function __construct(
        private ProvidesApiModels $modelProvider,
        private GeneratesJsonResponse $jsonResponse,
        private CommandBus $commandBus,
    ) {
    }
    /**
     * @Route("/api/register", methods={"POST"})
     *
     * @OA\Tag(name="Registration")
     *
     * @OA\Post(
     *     summary="Creates new User account",
     *     description="",
     *     operationId=self::class,
     *
     *     @OA\RequestBody(
     *         @Model(type=DTO\RegisterUser::class)
     *     ),
     *
     *     @OA\Response(
     *         response=Response::HTTP_CREATED,
     *         description="Created",
     *     ),
     *     @OA\Response(
     *         response=Response::HTTP_BAD_REQUEST,
     *         description="Invalid input",
     *     ),
     *     @OA\Response(
     *         response=Response::HTTP_INTERNAL_SERVER_ERROR,
     *         description="Application error",
     *     )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            /** @var DTO\RegisterUser $dto */
            $dto = $this->modelProvider->load($request->getContent(), DTO\RegisterUser::class);
        } catch (InvalidDto $exception) {
            return $this->jsonResponse->badRequest($exception->getMessage());
        } catch (\Throwable $exception) {
            return $this->jsonResponse->serverError(sprintf('[%s] %s', get_class($exception), $exception->getMessage()));
        }

        try {
            $this->commandBus->dispatch(new \App\Application\Command\RegisterUser($dto->email(), $dto->password()));
        } catch (InvalidInput $exception) {
            return $this->jsonResponse->badRequest($exception->getMessage());
        } catch (\Throwable $exception) {
            return $this->jsonResponse->serverError(sprintf('[%s] %s', get_class($exception), $exception->getMessage()));
        }

        return $this->jsonResponse->created();
    }
}
