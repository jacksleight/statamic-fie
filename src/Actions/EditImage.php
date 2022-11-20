<?php

namespace JackSleight\StatamicFie\Actions;

use App\ReplacementData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Statamic\Actions\Action;
use Statamic\Contracts\Assets\Asset;

class EditImage extends Action
{
    protected $asset;

    public function visibleTo($item)
    {
        if ($item instanceof Asset && $item->isImage()) {
            $this->asset = $item;

            return true;
        }

        return false;
    }

    public function visibleToBulk($items)
    {
        return false;
    }

    protected function fieldItems()
    {
        return [
            'image' => [
                'type' => 'fie',
                'source' => optional($this->asset)->absoluteUrl(),
            ],
        ];
    }

    public function run($assets, $values)
    {
        $asset = $assets->first();

        $image = $values['image'];

        if ($image['mode'] === 'save') {
            return $this->runSave($asset, $image);
        } else {
            return $this->runReplace($asset, $image);
        }
    }

    private function runSave($asset, $image)
    {
        $data = base64_decode(Arr::last(explode(',', $image['data'])));

        $file = tmpfile();
        $path = stream_get_meta_data($file)['uri'];
        file_put_contents($path, $data);

        $upload = new UploadedFile($path, $image['name'], null, 0, true);

        app()->terminating(function () use ($file) {
            fclose($file);
        });

        $container = $asset->container();

        $assetPath = ltrim($asset->folder().'/'.$image['name'], '/');

        $container->makeAsset($assetPath)->upload($upload);
    }

    private function runReplace($asset, $image)
    {
        $data = base64_decode(Arr::last(explode(',', $image['data'])));

        $file = new ReplacementData($data, $image['name']);

        $asset->reupload($file);

        $urls = [
            $asset->thumbnailUrl('small'),
            $asset->absoluteUrl(),
        ];

        return [
            'callback' => ['bustAndReloadImageCaches', $urls],
            'ids' => [$asset->id()],
        ];
    }

    public function buttonText()
    {
        return 'Save Image';
    }

    public function confirmationText()
    {
        return null;
    }
}
