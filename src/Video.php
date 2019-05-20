<?php

namespace BionSiviz\Yii2Video;

use yii\base\Widget;

/**
 * Widget display the video
 *
 * @author Andriy Ivanchenko <ivanchenko.andriy@gmail.com>
 */
class Video extends Widget {

    /**
     * Video
     *
     * @var string
     */
    public $video;

    /**
     * @inheritdoc
     */
    public function run(): string {
        if (!$this->video) {
            return '';
        }

        $videoUrl = new VideoUrl($this->video);

        return $this->render($videoUrl->getType(), ['src' => $videoUrl->getFrameSrc()]);
    }

}
