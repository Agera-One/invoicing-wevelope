<?php
$active = $pagination['active_page'];
$total  = $pagination['total_page'];
$qs = $search ? '&search=' . urlencode($search) : '';

function pg_range($active, $total) {
    $range = [];
    $range[] = 1;
    for ($i = $active - 1; $i <= $active + 1; $i++) {
        if ($i > 1 && $i < $total) $range[] = $i;
    }
    if ($total > 1) $range[] = $total;
    $range = array_unique($range);
    sort($range);

    $result = [];
    $prev = null;
    foreach ($range as $p) {
        if ($prev !== null && $p - $prev > 1) $result[] = '...';
        $result[] = $p;
        $prev = $p;
    }
    return $result;
}
?>
<div class="card-footer bg-transparent border-top d-flex justify-content-end p-3">
    <nav aria-label="Page navigation" class="m-0">
        <ul class="pagination pagination-dark m-0">

            <li class="page-item <?= $active <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=1<?= $qs ?>"><i class="bi bi-chevron-double-left"></i></a>
            </li>

            <li class="page-item <?= $active <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $active - 1 ?><?= $qs ?>"><i class="bi bi-chevron-left"></i></a>
            </li>

            <?php foreach (pg_range($active, $total) as $p): ?>
                <?php if ($p === '...'): ?>
                    <li class="page-item disabled"><span class="page-link page-dots">...</span></li>
                <?php else: ?>
                    <li class="page-item <?= $p == $active ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $p ?><?= $qs ?>"><?= $p ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>

            <li class="page-item <?= $active >= $total ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $active + 1 ?><?= $qs ?>"><i class="bi bi-chevron-right"></i></a>
            </li>

            <li class="page-item <?= $active >= $total ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $total ?><?= $qs ?>"><i class="bi bi-chevron-double-right"></i></a>
            </li>

        </ul>
    </nav>
</div>