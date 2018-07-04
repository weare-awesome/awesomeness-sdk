<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

Class Video extends ContentItem implements ContentTypeInterface
{

    /**
     * @param $provider
     *
     * @return string
     */
    private function getWrapper(
        $provider
    ) {
        switch ($provider) {
            case 'vimeo' : {
                return "<iframe class='Awesome__video' src='https://player.vimeo.com/video/$this->body' allow='autoplay; encrypted-media' allowFullScreen={true} ></iframe>";
            }
            case 'youtube' : {
                return "<iframe class='Awesome__video' src='https://www.youtube.com/embed/$this->body' allow='autoplay; encrypted-media' allowFullScreen={true} ></iframe>";
            }
            default:
                return '';
        }
    }

    /**
     * @param array $options
     *
     * @return string|void
     */
    public function render(array $options = [])
    {
        if (!$provider = $this->meta
            ->get('provider')
            ->getValue()
        ) {
            return '';
        }

        return $this->getWrapper($provider);
    }
}