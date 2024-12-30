<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Psr7\Response;

// use DebugBar\DataFormatter\DebugBarVarDumper;
use Illuminate\Http\Request;
use League\CommonMark\Util\UrlEncoder;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\VarDumper\VarDumper;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Stringable;

class ExampleRequestController extends Controller
{
    public function show(Request $request)
    {
        $path = $request->path();
        echo '$request->path()  : ', $path, '<br>';
        $url = $request->url();
        echo '$request->url()   : ', $url, '<br>';

        $u = $request->fullUrl();
        echo UrlEncoder::unescapeAndEncode($u);
        // var_dump($u);
        // echo $url;
        echo '<br>', $request->host(),
        '<br>', $request->httpHost(),
        '<br>', $request->schemeAndHttpHost();

        // $method = $request->method();

        // echo '<br>', $method instanceof Request;
        // if ($request->isMethod('get')) {
        //     // ...
        // }

        $value = $request->header('X-Header-Name');
        echo '<br>', $value;
        $value = $request->header('X-Header-Name', 'default');
        echo '<br>', $value;

        if ($request->hasHeader('X-Header-Name')) {
            // ...
        }
        echo  $request->bearerToken();

        echo $request->ip();
        $ipAddresses = $request->ips();
        var_dump($ipAddresses);
        //  ?   VarDumper

        $contentTypes = $request->getAcceptableContentTypes();
        echo '<pre>', var_dump($contentTypes);

        if ($request->accepts(['text/html', 'application/json'])) {
            echo 'Browser accepts text/html and application/json';
        }
        echo '<pre>', var_dump($request->prefers(['text/html', 'application/json']));

        if ($request->expectsJson()) {
            echo "accepts Json format";
        }
    }

    // public function psrpost(ServerRequestInterface $request)
    // {
    //     // Get uploaded files
    //     $uploadedFiles = $request->getUploadedFiles();

    //     if (!is_dir(storage_path('app/uploads'))) {
    //         mkdir(storage_path('app/uploads'), 0755, true);
    //     }

    //     // Check if 'name' file exists
    //     if (isset($uploadedFiles['name'])) {
    //         $file = $uploadedFiles['name'];

    //         // Get file information
    //         $fileName = $file->getClientFilename();
    //         $fileSize = $file->getSize();
    //         $fileType = $file->getClientMediaType();

    //         // Move the uploaded file to a directory (e.g., storage/app/uploads)
    //         $uploadPath = storage_path('app/uploads');
    //         $file->moveTo($uploadPath . '/' . $fileName);

    //         return response()->json([
    //             'name' => $fileName,
    //             'size' => $fileSize,
    //             'type' => $fileType,
    //         ]);
    //     }

    //     return response()->json(['message' => 'No file uploaded.'], 400);
    // }

    public function psrpost(Request $request)
    {
        echo '<pre>', var_dump($request->collect());
        var_dump($request->input());

        $firstProductName = $request->input('products.0');

        // Retrieve all product names
        $productNames = $request->input('products.*');

        return response()->json([
            'first_product_name' => $firstProductName,
            'all_product_names' => $productNames,
        ]);
    }
    public function psrget(Request $request)
    {
        // var_dump($request->query());
        // return view('getdata');

        var_dump($request->cookie());
    }
}
