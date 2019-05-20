<?php

namespace BionSiviz\Yii2Video;

use RicardoFiorani\Adapter\VideoAdapterInterface;
use RicardoFiorani\Exception\ServiceNotAvailableException;
use RicardoFiorani\Matcher\VideoServiceMatcher;

/**
 * Video URL
 *
 * @author Andriy Ivanchenko <ivanchenko.andriy@gmail.com>
 */
class VideoUrl
{
    /**
     * Video url
     *
     * @var string
     */
    protected $url;

    /**
     * Video adapter
     *
     * @var VideoAdapterInterface
     */
    protected $videoUrl;

    /**
     * Create adapter
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $matcher = new VideoServiceMatcher();
        $this->videoUrl = $matcher->parse($this->url);
    }

    /**
     * Get type of video URL
     *
     * @return string
     */
    public function getType()
    {
        if ($this->videoUrl) {
            return $this->videoUrl->getServiceName();
        }

        return 'Unknown';
    }

    /**
     * Get source URL for frame
     *
     * @return string
     */
    public function getFrameSrc()
    {
        if ($this->videoUrl) {
            return $this->videoUrl->getEmbedUrl();
        }

        return '';
    }

    /**
     * Is video URL recognized
     *
     * @return bool
     */
    public function isRecognized()
    {
        return $this->videoUrl instanceof VideoAdapterInterface;
    }
}
