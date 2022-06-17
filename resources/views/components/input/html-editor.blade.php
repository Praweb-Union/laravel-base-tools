@props(['label' => '', 'value' => '', 'placeholder' => ''])
<label for="html-editor" class="html-editor block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ $label }}</label>
<textarea {{ $attributes }} id="html-editor" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="{{ $placeholder }}">
    {{ $value }}
</textarea>
<script>
    tinymce.init({
        selector: 'textarea#html-editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>
