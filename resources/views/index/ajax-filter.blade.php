<? foreach ($items as $item): ?>
@include("_partials.story-item")
<? endforeach; ?>
{{ $items->appends(request()->input())->links() }}
