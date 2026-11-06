<?php declare(strict_types=1);
namespace Dravencms\BaseForm;

use Nette\Application\{Application, Response};
use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Template;
use Nette\Http\{IResponse, Session};

/** Lazy form components may create CSRF protection after a template has started output. */
final class FormSession
{
    public function __construct(private Session $session, private IResponse $httpResponse) {}

    public function prepare(Application $application, Response $response): void
    {
        if (!$response instanceof TextResponse || !$response->getSource() instanceof Template) { return; }
        $contentType = strtolower($this->httpResponse->getHeader('Content-Type') ?? 'text/html');
        if (str_starts_with($contentType, 'text/html')) { $this->session->start(); }
    }
}
