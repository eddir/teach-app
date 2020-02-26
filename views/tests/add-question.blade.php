<h2>Шаг 2: вопросы</h2>
<h3>(отправлено {{ $step - 1 }})</h3>
<input type="hidden" name="step" value="{{ $step }}" id="step">
<div class="form-group">
    <label for="question">Вопрос</label>
    <textarea name="question" id="" rows="5" class="form-control" id="question"></textarea>
</div>
<div class="form-group">
    <textarea name="description" id="" rows="4" cols="1" class="form-control" id="description" placeholder="Можно добавить пояснение к неверному ответу"></textarea>
</div>
<hr>
<h3>Ответы</h3>
<input type="hidden" name="answers_count" id="answers_count" value="4">
<div class="form-group">
    <div class="form-check" style="display: inline-block">
        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="options[1]">
    </div>
    <input type="text" name="answers[1]" id="answers[1]" class="form-control" placeholder="Текст ответа" style="display: inline-block; width: 80%;">
</div>
<div class="form-group">
    <div class="form-check" style="display: inline-block">
        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="options[2]">
    </div>
    <input type="text" name="answers[2]" id="answers[2]" class="form-control" placeholder="Текст ответа" style="display: inline-block; width: 80%;">
</div>
<div class="form-group">
    <div class="form-check" style="display: inline-block">
        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="options[3]">
    </div>
    <input type="text" name="answers[3]" id="answers[3]" class="form-control" placeholder="Текст ответа" style="display: inline-block; width: 80%;">
</div>
<div class="form-group">
    <div class="form-check" style="display: inline-block">
        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="options[4]">
    </div>
    <input type="text" name="answers[4]" id="answers[4]" class="form-control" placeholder="Текст ответа" style="display: inline-block; width: 80%;">
</div>
<small>Отметьте галочками верные ответы</small><br>
<input type="button" class="btn btn-primary" id="add_answer" value="Добавить ответ">
<input type="submit" class="btn btn-primary" id="add_question" value="Новый вопрос">
<input type="button" class="btn btn-success" id="finish" value="Завершить заполнение">

<script>
    $('#add_answer').on('click', function (t) {
        let i = $('#answers_count').val();
        $('#answers_count').val(++i);
        $('#add_answer').before('\n' +
            '<div class="form-group">\n' +
            '    <div class="form-check" style="display: inline-block">\n' +
            '        <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="options[' + i + ']">\n' +
            '    </div>\n' +
            '    <input type="text" name="answers[' + i + ']" id="answers[' + i + ']" class="form-control" placeholder="Текст ответа" style="display: inline-block; width: 80%;">\n' +
            '</div>');
    });
    $('#finish').on('click', function (t) {
        $.ajax({
            type: 'POST',
            url: '/ajax/newQuestion.php',
            data: $('#send_test_form').serialize()
        });
        window.location = '/';
    });
</script>