<? if (isset($sTitle)) { ?>
    <?php echo $this->element("admin/title", array("title" => $sTitle)); ?>
<? } 
?>
<br />
<strong>PreeoCMS uses Markdown for formatting. Here are the basics.</strong> See the <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">complete syntax</a>.
<br /><br />
<p>First Level Header</p>
<p>Making Scrambled Eggs: A Primer</p>
<p>===============================<p>
<p>Second Level Header</p>
<p>1.1: Preparation</p>
<p>----------------</p>
<p>Paragraphs</p>
<p>Add two new lines to start a new paragraph. Crack two eggs into the bowl and whisk.</p>
<p>Bold</p>
<p>**Carefully** crack the eggs.</p>
<p>Emphasis</p>
<p>Whisk the eggs *vigorously*.</p>
<p>Lists</p>
<p>Ingredients:<br />
- Eggs<br />
- Oil<br />
- *Optional:* milk<br />
</p>
<p>Links</p>
<p>To download a PDF version of the recipe, [click here](https://example.com/scrambled-eggs.pdf).</p>
<p>Images</p>
<p>![The Finished Dish](http://www.preeostudios.com/img/logos/preeostudios.png)</p>