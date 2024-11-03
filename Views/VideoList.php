<?php require_once __DIR__ . '/header.php'; ?>
<main class="listagem-videos">
  <ul class="videos__container" alt="videos alura">
    <?php foreach ($videoList as $video) :
      if (!str_starts_with($video->url, 'http')) :
        $video->url = "https://www.youtube.com/embed/5JGPs0jHY_I?si=cWZemRVd8jtyZPi1";
      endif; ?>
      <li class="videos__item">
        <?php if ($video->getFilePath() != null): ?>
          <a href="<?php echo $video->url ?>">
            <img src="/img/uploads/<?php echo $video->getFilePath(); ?>" alt="" style="width: 100%; max-height: 218px; object-fit: cover; overflow: hidden;">
          </a>
        <?php else: ?>
          <iframe width="100%" height="72%" src="<?php echo $video->url ?>"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        <?php endif; ?>
        <div class="descricao-video">
          <img src="./img/logo.png" alt="logo canal alura">
          <h3><?php echo $video->title ?></h3>
          <div class="acoes-video">
            <a href="/editar-video?id=<?php echo $video->id ?>">Editar</a>
            <a href="/remover-video?id=<?php echo $video->id ?>">Excluir</a>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</main>
<?php require_once __DIR__ . '/footer.php';
