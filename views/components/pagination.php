<nav aria-label="Page navigation example">
    <ul class="pagination">
      <!-- Voltar página -->
      <li class="page-item <?php echo 1 == $_GET['page'] || !isset($_GET['page']) || count($pages) <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="previousPage();">Anterior</a></li>
      <?php
        // verifica se a página foi definida
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // seta número da página de acordo com a quantidade de páginas
        $page = $page > count($pages) ? count($pages) : $page;
        // seta primeira página a ser exibida 
        $start = ($page > 5) ? $page - 5 : 1;
        // seta última página a ser exibida
        //$end = ($page > 5) ? $page + 4 : 10;
        $end = count($pages) < 10 ? count($pages) : 10;
        $end = $start + ($end - 1);
        // percorre página e cria link de páginação
        for ($i=$start; $i <= $end; $i++) { 
          ?>
            <li class="page-item <?php activePage('pessoas', 'active', ['page' => $i]); ?>"><a class="page-link" href="<?php url('pessoas?page='.$i); ?>"><?php echo $i; ?></a></li>
          <?php
        }
      ?>
      <!-- Avançar página -->
      <li class="page-item <?php echo count($pages) == $_GET['page'] || count($pages) <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0);" onclick="nextPage();">Próxima</a></li>
  </ul>
</nav>
