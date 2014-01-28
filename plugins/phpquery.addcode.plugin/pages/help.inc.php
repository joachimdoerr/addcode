<?php
/**
* phpQuery - Addcode Plugin
*
* @package redaxo 4.5.x
* @version 0.1.0
* @author  jdlx c/o rexdev.de
*/

$myself = 'phpquery.addcode.plugin';


echo '
<h1>phpQuery</h1>
<p><a target="_blank" href="https://github.com/punkave/phpQuery">https://github.com/punkave/phpQuery</a></p>

<p>This is phpQuery, a PHP port of jQuery selectors, super useful for DOM traversal and functional testing. Originally by Tobiasz Cudnik, who released it on Google Code. We forked it because we need some bug fixes and no commits have been made upstream for quite some time. Please share your phpQuery fixes with us!</p>

<h3>Example:</h3>
';


$example = '<?php
// INITIALIZE IT
// phpQuery::newDocumentHTML($markup);
// phpQuery::newDocumentXML();
// phpQuery::newDocumentFileXHTML(\'test.html\');
// phpQuery::newDocumentFilePHP(\'test.php\');
// phpQuery::newDocument(\'test.xml\', \'application/rss+xml\');
// this one defaults to text/html in utf8
$doc = phpQuery::newDocument(\'<div/>\');

// FILL IT
// array syntax works like ->find() here
$doc[\'div\']->append(\'<ul></ul>\');
// array set changes inner html
$doc[\'div ul\'] = \'<li>1</li> <li>2</li> <li>3</li>\';

// MANIPULATE IT
$li = null;
// almost everything can be a chain
$doc[\'ul > li\']
  ->addClass(\'my-new-class\')
  ->filter(\':last\')
    ->addClass(\'last-li\')
// save it anywhere in the chain
    ->toReference($li);

// SELECT DOCUMENT
// pq(); is using selected document as default
phpQuery::selectDocument($doc);
// documents are selected when created or by above method
// query all unordered lists in last selected document
$ul = pq(\'ul\')->insertAfter(\'div\');

// ITERATE IT
// all direct LIs from $ul
foreach($ul[\'> li\'] as $li) {
  // iteration returns PLAIN dom nodes, NOT phpQuery objects
  $tagName = $li->tagName;
  $childNodes = $li->childNodes;
  // so you NEED to wrap it within phpQuery, using pq();
  pq($li)->addClass(\'my-second-new-class\');
}

// PRINT OUTPUT
// 1st way
print phpQuery::getDocument($doc->getDocumentID());
// 2nd way
print phpQuery::getDocument(pq(\'div\')->getDocumentID());
// 3rd way
print pq(\'div\')->getDocument();
// 4th way
print $doc->htmlOuter();
// 5th way
print $doc;
// another...
print $doc[\'ul\'];
?>
';

rex_highlight_string($example);

