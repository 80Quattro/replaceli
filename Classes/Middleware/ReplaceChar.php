<?php
declare(strict_types=1);

namespace StudioMitte\Replaceli\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\Stream;


class ReplaceChar implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $content = (string)$response->getBody();

        $content = str_replace('ß', 'ss', $content);
        $body = new Stream('php://temp', 'rw');
        $body->write($content);

        $request = $request->withBody($body);
        return $handler->handle($request);
    }
}
