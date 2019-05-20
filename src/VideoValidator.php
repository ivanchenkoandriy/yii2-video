<?php

namespace BionSiviz\Yii2Video;

use Exception;
use Yii;
use yii\validators\Validator;

/**
 * The validator for video URL
 *
 * @author Andriy Ivanchenko <ivanchenko.andriy@gmail.com>
 */
class VideoValidator extends Validator {

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute) {
        if (!$model->{$attribute}) {
            return;
        }

        try {
            $videoUrl = new VideoUrl($model->{$attribute});
            $videoUrl->isRecognized() || $this->addError($model, $attribute, Yii::t('app', 'This link to the video could not be recognized.'));
        } catch (\RicardoFiorani\Matcher\Exception\VideoServiceNotCompatibleException $ex) {
            $this->addError($model, $attribute, $ex->getMessage());
        } catch (\RicardoFiorani\Adapter\Exception\NotEmbeddableException $ex) {
            $this->addError($model, $attribute, $ex->getMessage());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
