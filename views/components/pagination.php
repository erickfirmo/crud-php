<nav aria-label="Page navigation example">
    <ul class="pagination">
    <li class="page-item <?php echo 1 == $_GET['page'] || !isset($_GET['page']) || count($pages) <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="previousPage();">Anterior</a></li>
    <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $start = ($page > 5) ? $page - 5 : 1;
      $end = ($page > 5) ? $page + 4 : 10;
      $end = count($pages) > 10 ? 10 : count($pages);

      for ($i=$start; $i <= $end; $i++) { 
        ?>
          <li class="page-item <?php activePage('pessoas', 'active', ['page' => $i]); ?>"><a class="page-link" href="<?php url('pessoas?page='.$i); ?>"><?php echo $i; ?></a></li>
        <?php
      }
    ?>
    <li class="page-item <?php echo count($pages) == $_GET['page'] || count($pages) <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="nextPage();">Próxima</a></li>
  </ul>
</nav>
