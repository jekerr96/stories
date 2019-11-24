<? foreach ($items as $item): ?>
@include("_partials.story-item")
<? endforeach; ?>
{{ $items->links() }}
