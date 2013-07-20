{if $layout_template==''}{assign var=layout_template value="vm_global_layout.tpl"}{/if}
{if $content_template}{include file=$layout_template content_template=$content_template}{/if}
