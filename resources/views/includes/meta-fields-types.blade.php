<optgroup label="Загальне">
    <option value="text" @selected("text" == $type)>Текст</option>
    <option value="textarea" @selected("textarea" == $type)>Область тексту</option>
    <option value="number" @selected("number" == $type)>Число</option>
    <option value="email" @selected("email" == $type)>E-mail</option>
    <option value="url" @selected("url" == $type)>Url</option>
    <option value="password" @selected("password" == $type)>Пароль</option>
</optgroup>
<optgroup label="Вміст">
    <option value="image" @selected("image" == $type)>Зображення</option>
    <option value="images_gallery" @selected("images_gallery" == $type)>Галерея зображень</option>
    <option value="ckeditor" disabled @selected("ckeditor" == $type)>Візуальний редактор</option>
    {{-- <option value="wysiwyg" disabled @selected("wysiwyg" == $type)>Візуальний редактор</option> --}}
</optgroup>
<optgroup label="Вибір">
    <option value="select" @selected("select" == $type)>Select</option>
    <option value="checkbox" disabled @selected("checkbox" == $type)>Галочка</option>
    <option value="radio" disabled @selected("radio" == $type)>Radio Button</option>
    <option value="true_false" disabled @selected("true_false" == $type)>Так / Ні</option>
</optgroup>
<optgroup label="Шаблон структуры">
    <option value="group" @selected("group" == $type)>Група</option>
</optgroup>