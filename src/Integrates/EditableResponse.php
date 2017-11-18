<?php
namespace Editable\Integrates;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class EditableResponse implements ResponseInterface {
    /**
     * @var int 状态码
     */
    var $status_code = -1;

    /**
     * @var JSONStringArrayAccess
     */
    var $body = null;

    /**
     * @param  int      $status_code
     * @param  mixed    $body
     */
    public function __construct($status_code = null, $body = null)
    {
        if ($status_code !== null) {
            $this->status_code = $status_code;
        }
        if ($body !== null) {
            $this->body = $body;
        }
    }
    


    /**
     * Gets the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }


    /**
     * Gets the body of the message.
     *
     * @return JSONStringArrayAccess
     */
    public function getBody()
    {
        return $this->body;
    }

    public function getProtocolVersion() {}
    public function withProtocolVersion($version) {}
    public function getHeaders() {}
    public function hasHeader($name) {}
    public function getHeader($name) {}
    public function getHeaderLine($name) {}
    public function withHeader($name, $value) {}
    public function withAddedHeader($name, $value) {}
    public function withoutHeader($name) {}
    public function withBody(StreamInterface $body) {}
    public function withStatus($code, $reasonPhrase = '') {}
    public function getReasonPhrase() {}
}