<main role="main" class="articles-list wrapper">
    <ul>
        <?php
            foreach ($articles as $article) { /* Parcours de la liste des articles */
                // Récupération de l'image de l'aperçu
                $previewImage = ImageModel::findById($article->getPreviewImageId());

                echo '
                <li>
                    <article class="shot">
                        <a href="' . $article->getFullLink() . '"><img src="public/rsc/img/" alt="image preview" /></a>
                        <span>
                            <h2><a href="' . $article->getFullLink() . '">' . $article->getTitle() . '</a></h2>
                            <h4><a href="' . $article->getFullLink() . '">' . $article->getDatePublishedFormatted() . '</a></h4>
                            <p class="short-desc">
                                ' . $article->getShortDescription() . '
                            </p>
                        </span>
                    </article>
                </li>    
                ';
                // Destruction de la variable de l'aperçu
                unset($previewImage);
            }
        ?>
    </ul>
</main>