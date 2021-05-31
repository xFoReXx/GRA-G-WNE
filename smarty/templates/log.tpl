<table class="table table-bordered">
{foreach from=$logArray item=logLine}
<tr>
<td>{$logLine.timestamp|date_format:$config.datetime}</td>
<td>{$logLine.sender}</td>
<td>{$logLine.message}</td>
<td>{$logLine.type}</td>
</tr>
{/foreach}
</table>