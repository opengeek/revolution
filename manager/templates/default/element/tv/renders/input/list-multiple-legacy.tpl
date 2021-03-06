<select id="tv{$tv->id}" name="tv{$tv->id}[]" multiple
style="{if $params.listWidth|default}width: {$params.listWidth|default};{else}width: 400px;{/if}
{if $params.listHeight|default}height: {$params.listHeight|default};{else}height: 100px;{/if}"
class="modx-tv-legacy-select">
    {foreach from=$opts item=item}
        <option value="{$item.value}" {if $item.selected}selected="selected"{/if}>{$item.text}</option>
    {/foreach}
</select>

<script type="text/javascript">
// <![CDATA[
{literal}
Ext.onReady(function() {
    var el = Ext.get('{/literal}tv{$tv->id}{literal}');
    el.on('change', MODx.fireResourceFormChange, el);
});
{/literal}
// ]]>
</script>