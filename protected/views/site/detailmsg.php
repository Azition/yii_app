<h2>Подробнее</h2>
<?
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        [
            'name' => 'title',
            'label' => 'Тема',
        ],
        [
            'name' => 'status',
            'label' => 'Статус',
            'value' => $model->statusMessage($model->status),
        ],
        [
            'name' => 'description',
            'label' => 'Вопрос',
        ],
        [
            'name' => 'answer',
            'label' => 'Ответ',
        ],
    ),
));

echo CHTML::link('Назад',['site/index'])
?>