<nav aria-label="Page navigation example">
  <ul class="pagination">
  <li class="page-item <?php echo 1 == $_GET['page'] || !isset($_GET['page']) ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="previousPage();">Anterior</a></li>
    <?php foreach($pages as $page) { ?>
            <li class="page-item <?php activePage('pessoas', 'active', ['page' => $page]); ?>"><a class="page-link" href="<?php url('pessoas?page='.$page); ?>"><?php echo $page; ?></a></li>
    <?php } ?>
    <li class="page-item <?php echo count($pages) == $_GET['page'] ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="nextPage();">Próxima</a></li>
  </ul>
</nav>