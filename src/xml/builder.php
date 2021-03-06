<?php
/**
 * Helper classes and functions for generating XML documents.
 *
 * @copyright 2013 Pontus Östlund
 * @author    Pontus Östlund <poppanator@gmail.com>
 * @link      https://github.com/poppa/PLib
 * @license   http://opensource.org/licenses/GPL-3.0 GPL License 3
 * @package   PLib\XML
 */

namespace PLib\XML;

require_once PLIB_PATH . '/xml/qname.php';

/**
 * Type constant for XMLNode
 */
define ('XML_BUILDER_NODE',     1);

/**
 * Type constant for XMLDocument
 */
define ('XML_BUILDER_DOCUMENT', 2);

/**
 * A container class that represents a "fake" DomNode.
 * This class contains shortcuts to alter a domdocument tree.
 * This class should not be instantiated on its own but should be created
 * through the XMLDocument class.
 *
 * @author Pontus Östlund <poppanator@gmail.com>
 */
class XMLNode
{
  /**
   * Type
   * @var int
   */
  protected $type = XML_BUILDER_NODE;

  /**
   * The real DOMElement node
   * @var DOMElement
   */
  protected $node;

  /**
   * The owner document
   * @var XMLDocument
   */
  protected $owner;

  /**
   * The {@link DOMDocument} of the owner document
   * @var DOMDocument
   */
  protected $doc;

  /**
   * Creates a new XMLNode
   *
   * @param XMLDocument $owner
   *  The document to which this node belongs
   */
  protected function __construct (XMLDocument &$owner)
  {
    $this->owner = $owner;
    $this->doc   = &$owner->domdoc();
  }

  /**
   * Add a node to the XML document
   *
   * @param string $name
   *  Node name
   * @param string $val
   *  Node value
   * @param array $attr
   *  Node attributes as an associative array
   *  `array('attr' => 'val'[, 'attr' => 'val'])`
   * @return XMLNode
   */
  public function add_node ($name, $value=null, array $attributes=array())
  {
    $n  = $this->node ? new self ($this->owner) : $this;
    $e  = $this->doc->createElement ((string)$name);

    if ($value) {
      $e->appendChild (
        $this->doc->createTextNode (html_entity_decode ($value)));
    }

    if ($this->node)
      $n->node = $this->node->appendChild ($e);
    else
      $n->node = $this->node = $this->doc->appendChild ($e);

    unset ($e);

    if ($attributes)
      $n->set_attributes ($attributes);

    return $n;
  }

  /**
   * Returns the {@see DOMNode} of this object.
   *
   * @return DOMNode
   */
  public function get_node ()
  {
    return $this->node;
  }

  /**
   * Add a namespace node
   *
   * @param name $name
   * @param string $value
   * @param QName $ns
   */
  public function add_ns_node ($name, $value, QName $ns)
  {
    $n = $this->node ? new self ($this->owner) : $this;
    if ($value) $value = safe_xml ($value);
    $nsn = $this->doc->createElementNS ($ns->namespace_uri (), $name, $value);

    if ($this->node)
      $n->node = $this->node->appendChild ($nsn);
    else
      $n->node = $this->node = $this->doc->appendChild ($nsn);

    unset ($nsn);

    return $n;
  }

  /**
   * Appends an {@link DOMElement} to the current node.
   *
   * The $node can either be a raw DOMElement node from a regular
   * {@link DOMDocument} or an {@link XMLNode}. If the latter the real
   * DOMElement node of the XMLNode object will be appended.
   *
   * @throws Exception
   * @param DOMNode|XMLNode $node
   * @return XMLNode
   *  The newly created node
   */
  public function add_dom_node($node)
  {
    if ($node instanceof XMLNode)
      $node = $node->node;

    if (!($node instanceof DOMElement)) {
      throw new \Exception (
        "The node given to <strong>XMLNode::add_dom_node()</strong> is not " .
        "a DOMNode object"
      );
    }

    $node = $this->doc->importNode ($node, true);
    $n = new self ($this->owner);
    $n->node = $this->node->appendChild ($node);
    return $n;
  }

  /**
   * Add an XML string to the current node.
   *
   * @param string $tree
   * @return XMLNode
   *  The newly created node object
   */
  function add_node_tree ($tree)
  {
    $xdoc = new \DOMDocument ('1.0', $this->owner->encoding());
    $xdoc->preserveWhiteSpace = false;
    $xdoc->loadXML ($tree);

    $t = $this->doc->importNode ($xdoc->firstChild, true);

    $n = clone $this;
    $n->node = $this->node ? $this->node->appendChild ($t) :
                             $this->doc->appendChild ($t);

    unset ($xdoc, $tree, $t);

    return $n;
  }

  /**
   * Append content as a CDATA section
   *
   * @param string $name
   * @param string $value
   * @return XMLNode
  */
  public function add_cdata_node ($name, $value)
  {
    $n = $this->node ? new self ($this->owner) : $this;

    $e = $this->doc->createElement ($name);
    $c = $this->doc->createCDATASection ($value);
    $e->appendChild ($c);

    if (!$this->node)
      $n->node = $this->node = $this->doc->appendChild ($e);
    else
      $n->node = $this->node->appendChild ($e);

    unset ($e, $c);

    return $n;
  }

  /**
   * Add processing instruction
   *
   * @param string $name
   * @param string $data
   */
  public function add_processing_instruction ($name, $data)
  {
    $n = $this->node ? new self ($this->owner) : $this;
    $e = $this->doc->createProcessingInstruction ($name, $data);

    if (!$this->node)
      $n->node = $this->node = $this->doc->appendChild ($e);
    else
      $n->node = $this->node->appendChild ($e);

    unset ($e);

    return $n;
  }

  /**
   * Add comment
   *
   * @param string $data
   */
  public function add_comment ($data)
  {
    $n = $this->node ? new self ($this->owner) : $this;
    $e = $this->doc->createComment ($data);

    if (!$this->node)
      $n->node = $this->node = $this->doc->appendChild ($e);
    else
      $n->node = $this->node->appendChild ($e);

    unset ($e);

    return $n;
  }

  /**
   * Replace the current node with $to
   *
   * @throws Exception
   * @param DOMElement|XMLNode $to
   */
  public function replace_with ($to)
  {
    if ($to instanceof XMLNode)
      $to = $to->node;

    if (!($to instanceof DOMElement)) {
      throw new \Exception (
        "The node given to \"XMLNode::replace_with()\" is not " .
        "a DOMNode object"
      );
    }

    $to = $this->doc->importNode ($to, true);
    $this->node->parentNode->replaceChild ($to, $this->node);
  }

  /**
   * Removes all nodes with the name $which
   *
   * @param string $which
    */
  public function remove_node_by_name ($which)
  {
    $nodes = $this->doc->getElementsByTagName ($which);

    if (sizeof ($nodes))
      foreach ($nodes as $node)
        $node->parentNode->removeChild ($node);
  }

  /**
   * Set an attribute to the node
   *
   * @param string $name
   *  The attribute name
   * @param mixed $value
   *  The attribute value
   */
  public function set_attribute ($name, $value)
  {
    $this->node->setAttribute ($name, $value);
  }

  /**
   * Set attributes to the node
   *
   * @param array $attr
   *  Associative array
   * @return void
   */
  public function set_attributes (array $attributes)
  {
    foreach ($attributes as $k => $v)
      $this->set_attribute ($k, $v);
  }

  /**
   * Render the current node to a string
   *
   * @return string
   */
  public function render ()
  {
    return $this->doc->saveXML ($this->node);
  }

  /**
   * Render the current node to a string as HTML
   *
   * @return string
   */
  public function render_html ()
  {
    return $this->doc->saveHTML ($this->node);
  }

  /**
   * Returns the contents of the node without the node it self.
   *
   * @return string
   */
  public function inner_xml ()
  {
    $str = '';
    foreach ($this->node->childNodes as $cn)
      $str .= $this->doc->saveXML ($cn);

    return $str;
  }

  /**
   * Returns the contents of the node without the node it self as HTML.
   *
   * @return string
   */
  public function inner_html ()
  {
    $str = '';
    foreach ($this->node->childNodes as $cn)
      $str .= $this->doc->saveHTML ($cn);

    return $str;
  }

  /**
   * Cast this object to string.
   *
   * @see XMLNode::render()
   * @return string
   */
  public function __toString ()
  {
    return $this->render ();
  }
}

/**
 * Class to simplify the creation of XML documents
 *
 * @author Pontus Östlund <poppanator@gmail.com>
 */
class XMLDocument extends XMLNode
{
  /**
   * Type
   * @var int
   */
  protected $type = XML_BUILDER_DOCUMENT;

  /**
   * The {@link DOMDocument}
   * @var DOMDocument
   */
  protected $doc;

  /**
   * The version attribute of the XML declaration
   * @var string
   */
  protected $version;

  /**
   * Document encoding
   * @var string
   */
  protected $encoding;

  /**
   * Creates a new XMLDocument object
   *
   * @param string $version
   * @param string $encoding
   */
  public function __construct ($version='1.0', $encoding='utf-8')
  {
    $this->version = $version;
    $this->encoding = strtolower ($encoding);

    if (!$this->doc)
      $this->doc = new \DOMDocument ($version, $this->encoding);

    $this->doc->substituteEntities = false;
    $this->doc->preserveWhiteSpace = false;
    $this->owner = $this;
  }

  /**
   * Returns the {@link DOMDocument} of this object
   * @return DOMDocument
   */
  public function domdoc ()
  {
    return $this->doc;
  }

  /**
   * render the object to XML
   *
   * @param bool $html
   *  render into HTML format
   * @param bool $format
   *  Format the output (i.e. indentation)
   * @return string
   */
  public function render ($html=false, $format=null, $declaration=true)
  {
    if ($format !== null)
      $this->doc->formatOutput = $format;

    if ($html) {
      $ret = null;

      if ($format === true) {
        $d = new \DOMDocument ();
        $d->preserveWhiteSpace = true;
        $d->loadXML ($this->doc->saveXML ());
        $d->formatOutput = true;
        $ret = $d->saveHTML ();
      }
      else
        $ret = $this->doc->saveHTML ();

      return $ret;
    }

    if (!$declaration) {
      $r = explode("\n", $this->doc->saveXML ());
      array_shift ($r);
      return join ("\n", $r);
    }

    return $this->doc->saveXML ();
  }

  /**
   * Returns the encoding
   *
   * @return string
   */
  public function encoding ()
  {
    return $this->encoding;
  }
}

/**
 * Creates a HTML5 document
 *
 * @author Pontus Östlund <poppanator@gmail.com>
 */
class HTMLDocument extends XMLDocument
{
  /**
   * Constructor
   *
   * @param string $encoding
   */
  public function __construct ($encoding='utf-8')
  {
    $imp = new \DOMImplementation ();
    $dtd = $imp->createDocumentType ('html', null, null);
    $this->doc = $imp->createDocument ('','', $dtd);

    unset ($dtd, $imp);

    parent::__construct (null, $encoding);
  }

  /**
   * Render the document to a string
   *
   * @param bool $format_output
   */
  public function render ($format_output=null)
  {
    return parent::render (true, $format_output, false);
  }
}

/**
 * XML/HTML entities
 *
 * @author Pontus Östlund <poppanator@gmail.com>
 */
class Ent
{
  /**
   * ISO-8859-1 entitites
   * @var array
   */
  public static $iso88591 = array(
    "&nbsp;"   => " ",
    "&iexcl;"  => "¡",
    "&cent;"   => "¢",
    "&pound;"  => "£",
    "&curren;" => "¤",
    "&yen;"    => "¥",
    "&brvbar;" => "¦",
    "&sect;"   => "§",
    "&uml;"    => "¨",
    "&copy;"   => "©",
    "&ordf;"   => "ª",
    "&laquo;"  => "«",
    "&not;"    => "¬",
    "&shy;"    => "­",
    "&reg;"    => "®",
    "&macr;"   => "¯",
    "&deg;"    => "°",
    "&plusmn;" => "±",
    "&sup2;"   => "²",
    "&sup3;"   => "³",
    "&acute;"  => "´",
    "&micro;"  => "µ",
    "&para;"   => "¶",
    "&middot;" => "·",
    "&cedil;"  => "¸",
    "&sup1;"   => "¹",
    "&ordm;"   => "º",
    "&raquo;"  => "»",
    "&frac14;" => "¼",
    "&frac12;" => "½",
    "&frac34;" => "¾",
    "&iquest;" => "¿",
    "&Agrave;" => "À",
    "&Aacute;" => "Á",
    "&Acirc;"  => "Â",
    "&Atilde;" => "Ã",
    "&Auml;"   => "Ä",
    "&Aring;"  => "Å",
    "&AElig;"  => "Æ",
    "&Ccedil;" => "Ç",
    "&Egrave;" => "È",
    "&Eacute;" => "É",
    "&Ecirc;"  => "Ê",
    "&Euml;"   => "Ë",
    "&Igrave;" => "Ì",
    "&Iacute;" => "Í",
    "&Icirc;"  => "Î",
    "&Iuml;"   => "Ï",
    "&ETH;"    => "Ð",
    "&Ntilde;" => "Ñ",
    "&Ograve;" => "Ò",
    "&Oacute;" => "Ó",
    "&Ocirc;"  => "Ô",
    "&Otilde;" => "Õ",
    "&Ouml;"   => "Ö",
    "&times;"  => "×",
    "&Oslash;" => "Ø",
    "&Ugrave;" => "Ù",
    "&Uacute;" => "Ú",
    "&Ucirc;"  => "Û",
    "&Uuml;"   => "Ü",
    "&Yacute;" => "Ý",
    "&THORN;"  => "Þ",
    "&szlig;"  => "ß",
    "&agrave;" => "à",
    "&aacute;" => "á",
    "&acirc;"  => "â",
    "&atilde;" => "ã",
    "&auml;"   => "ä",
    "&aring;"  => "å",
    "&aelig;"  => "æ",
    "&ccedil;" => "ç",
    "&egrave;" => "è",
    "&eacute;" => "é",
    "&ecirc;"  => "ê",
    "&euml;"   => "ë",
    "&igrave;" => "ì",
    "&iacute;" => "í",
    "&icirc;"  => "î",
    "&iuml;"   => "ï",
    "&eth;"    => "ð",
    "&ntilde;" => "ñ",
    "&ograve;" => "ò",
    "&oacute;" => "ó",
    "&ocirc;"  => "ô",
    "&otilde;" => "õ",
    "&ouml;"   => "ö",
    "&divide;" => "÷",
    "&oslash;" => "ø",
    "&ugrave;" => "ù",
    "&uacute;" => "ú",
    "&ucirc;"  => "û",
    "&uuml;"   => "ü",
    "&yacute;" => "ý",
    "&thorn;"  => "þ",
    "&yuml;"   => "ÿ"
  );

  /**
   * International entities
   * @var array
   */
  public static $international = array(
    /*
    "&OElig;"  => "\x0152",
    "&oelig;"  => "\x0153",
    "&Scaron;" => "\x0160",
    "&scaron;" => "\x0161",
    "&Yuml;"   => "\x0178",
    "&circ;"   => "\x02C6",
    "&tilde;"  => "\x02DC",
    "&ensp;"   => "\x2002",
    "&emsp;"   => "\x2003",
    "&thinsp;" => "\x2009",
    "&zwnj;"   => "\x200C",
    "&zwj;"    => "\x200D",
    "&lrm;"    => "\x200E",
    "&rlm;"    => "\x200F",
    "&ndash;"  => "\x2013",
    "&mdash;"  => "\x2014",
    "&lsquo;"  => "\x2018",
    "&rsquo;"  => "\x2019",
    "&sbquo;"  => "\x201A",
    "&ldquo;"  => "\x201C",
    "&rdquo;"  => "\x201D",
    "&bdquo;"  => "\x201E",
    "&dagger;" => "\x2020",
    "&Dagger;" => "\x2021",
    "&permil;" => "\x2030",
    "&lsaquo;" => "\x2039",
    "&rsaquo;" => "\x203A",
    "&euro;"   => "\x20AC"
    */
  );

  /**
   * Symbols
   * @var array
   */
  public static $symbols = array(
    /*
    "&fnof;"     => "\x0192",
    "&thetasym;" => "\x03D1",
    "&upsih;"    => "\x03D2",
    "&piv;"      => "\x03D6",
    "&bull;"     => "\x2022",
    "&hellip;"   => "\x2026",
    "&prime;"    => "\x2032",
    "&Prime;"    => "\x2033",
    "&oline;"    => "\x203E",
    "&frasl;"    => "\x2044",
    "&weierp;"   => "\x2118",
    "&image;"    => "\x2111",
    "&real;"     => "\x211C",
    "&trade;"    => "\x2122",
    "&alefsym;"  => "\x2135",
    "&larr;"     => "\x2190",
    "&uarr;"     => "\x2191",
    "&rarr;"     => "\x2192",
    "&darr;"     => "\x2193",
    "&harr;"     => "\x2194",
    "&crarr;"    => "\x21B5",
    "&lArr;"     => "\x21D0",
    "&uArr;"     => "\x21D1",
    "&rArr;"     => "\x21D2",
    "&dArr;"     => "\x21D3",
    "&hArr;"     => "\x21D4",
    "&forall;"   => "\x2200",
    "&part;"     => "\x2202",
    "&exist;"    => "\x2203",
    "&empty;"    => "\x2205",
    "&nabla;"    => "\x2207",
    "&isin;"     => "\x2208",
    "&notin;"    => "\x2209",
    "&ni;"       => "\x220B",
    "&prod;"     => "\x220F",
    "&sum;"      => "\x2211",
    "&minus;"    => "\x2212",
    "&lowast;"   => "\x2217",
    "&radic;"    => "\x221A",
    "&prop;"     => "\x221D",
    "&infin;"    => "\x221E",
    "&ang;"      => "\x2220",
    "&and;"      => "\x2227",
    "&or;"       => "\x2228",
    "&cap;"      => "\x2229",
    "&cup;"      => "\x222A",
    "&int;"      => "\x222B",
    "&there4;"   => "\x2234",
    "&sim;"      => "\x223C",
    "&cong;"     => "\x2245",
    "&asymp;"    => "\x2248",
    "&ne;"       => "\x2260",
    "&equiv;"    => "\x2261",
    "&le;"       => "\x2264",
    "&ge;"       => "\x2265",
    "&sub;"      => "\x2282",
    "&sup;"      => "\x2283",
    "&nsub;"     => "\x2284",
    "&sube;"     => "\x2286",
    "&supe;"     => "\x2287",
    "&oplus;"    => "\x2295",
    "&otimes;"   => "\x2297",
    "&perp;"     => "\x22A5",
    "&sdot;"     => "\x22C5",
    "&lceil;"    => "\x2308",
    "&rceil;"    => "\x2309",
    "&lfloor;"   => "\x230A",
    "&rfloor;"   => "\x230B",
    "&lang;"     => "\x2329",
    "&rang;"     => "\x232A",
    "&loz;"      => "\x25CA",
    "&spades;"   => "\x2660",
    "&clubs;"    => "\x2663",
    "&hearts;"   => "\x2665",
    "&diams;"    => "\x2666"
     */
  );

  /**
   * Greek entitites
   * @var array
   */
  public static $greek = array(
    /*
    "&Alpha;"   => "\x391",
    "&Beta;"    => "\x392",
    "&Gamma;"   => "\x393",
    "&Delta;"   => "\x394",
    "&Epsilon;" => "\x395",
    "&Zeta;"    => "\x396",
    "&Eta;"     => "\x397",
    "&Theta;"   => "\x398",
    "&Iota;"    => "\x399",
    "&Kappa;"   => "\x39A",
    "&Lambda;"  => "\x39B",
    "&Mu;"      => "\x39C",
    "&Nu;"      => "\x39D",
    "&Xi;"      => "\x39E",
    "&Omicron;" => "\x39F",
    "&Pi;"      => "\x3A0",
    "&Rho;"     => "\x3A1",
    "&Sigma;"   => "\x3A3",
    "&Tau;"     => "\x3A4",
    "&Upsilon;" => "\x3A5",
    "&Phi;"     => "\x3A6",
    "&Chi;"     => "\x3A7",
    "&Psi;"     => "\x3A8",
    "&Omega;"   => "\x3A9",
    "&alpha;"   => "\x3B1",
    "&beta;"    => "\x3B2",
    "&gamma;"   => "\x3B3",
    "&delta;"   => "\x3B4",
    "&epsilon;" => "\x3B5",
    "&zeta;"    => "\x3B6",
    "&eta;"     => "\x3B7",
    "&theta;"   => "\x3B8",
    "&iota;"    => "\x3B9",
    "&kappa;"   => "\x3BA",
    "&lambda;"  => "\x3BB",
    "&mu;"      => "\x3BC",
    "&nu;"      => "\x3BD",
    "&xi;"      => "\x3BE",
    "&omicron;" => "\x3BF",
    "&pi;"      => "\x3C0",
    "&rho;"     => "\x3C1",
    "&sigmaf;"  => "\x3C2",
    "&sigma;"   => "\x3C3",
    "&tau;"     => "\x3C4",
    "&upsilon;" => "\x3C5",
    "&phi;"     => "\x3C6",
    "&chi;"     => "\x3C7",
    "&psi;"     => "\x3C8",
    "&omega;"   => "\x3C9"
     */
  );

  /**
   * HTML entities
   * @var array
   */
  public static $html = array(
    '&quot;',  '&apos;',  '&amp;',   '&lt;',    '&gt;',    '&nbsp;',
    '&iexcl;', '&curren;','&cent;',  '&pound;', '&yen;',   '&brvbar;',
    '&sect;',  '&uml;',   '&copy;',  '&ordf;',  '&laquo;', '&not;',
    '&shy;',   '&reg;',   '&trade;', '&macr;',  '&deg;',   '&plusmn;',
    '&sup2;',  '&sup3;',  '&acute;', '&micro;', '&para;',  '&middot;',
    '&cedil;', '&sup1;',  '&ordm;',  '&raquo;', '&frac14;','&frac12;',
    '&frac34;','&iquest;','&times;', '&divide;','&Agrave;','&Aacute;',
    '&Acirc;', '&Atilde;','&Auml;',  '&Aring;', '&AElig;', '&Ccedil;',
    '&Egrave;','&Eacute;','&Ecirc;', '&Euml;',  '&Igrave;','&Iacute;',
    '&Icirc;', '&Iuml;',  '&ETH;',   '&Ntilde;','&Ograve;','&Oacute;',
    '&Ocirc;', '&Otilde;','&Ouml;',  '&Oslash;','&Ugrave;','&Uacute;',
    '&Ucirc;', '&Uuml;',  '&Yacute;','&THORN;', '&szlig;', '&agrave;',
    '&aacute;','&acirc;', '&atilde;','&auml;',  '&aring;', '&aelig;',
    '&ccedil;','&egrave;','&eacute;','&ecirc;', '&euml;',  '&igrave;',
    '&iacute;','&icirc;', '&iuml;',  '&eth;',   '&ntilde;','&ograve;',
    '&oacute;','&ocirc;', '&otilde;','&ouml;',  '&oslash;','&ugrave;',
    '&uacute;','&ucirc;', '&uuml;',  '&yacute;','&thorn;', '&yuml;',
    '&OElig;', '&oelig;', '&Scaron;','&scaron;','&Yuml;',  '&circ;',
    '&tilde;', '&ensp;',  '&emsp;',  '&thinsp;','&zwnj;',  '&zwj;',
    '&lrm;',   '&rlm;',   '&ndash;', '&mdash;', '&lsquo;', '&rsquo;',
    '&sbquo;', '&ldquo;', '&rdquo;', '&bdquo;', '&dagger;','&Dagger;',
    '&hellip;','&permil;','&lsaquo;','&rsaquo;','&euro;'
  );

  /**
   * XML entitites
   * @var array
   */
  public static $xml = array(
    '&#34;',  '&#39;',  '&#38;',  '&#60;',  '&#62;',  '&#160;',
    '&#161;', '&#164;', '&#162;', '&#163;', '&#165;', '&#166;',
    '&#167;', '&#168;', '&#169;', '&#170;', '&#171;', '&#172;',
    '&#173;', '&#174;', '&#8482;','&#175;', '&#176;', '&#177;',
    '&#178;', '&#179;', '&#180;', '&#181;', '&#182;', '&#183;',
    '&#184;', '&#185;', '&#186;', '&#187;', '&#188;', '&#189;',
    '&#190;', '&#191;', '&#215;', '&#247;', '&#192;', '&#193;',
    '&#194;', '&#195;', '&#196;', '&#197;', '&#198;', '&#199;',
    '&#200;', '&#201;', '&#202;', '&#203;', '&#204;', '&#205;',
    '&#206;', '&#207;', '&#208;', '&#209;', '&#210;', '&#211;',
    '&#212;', '&#213;', '&#214;', '&#216;', '&#217;', '&#218;',
    '&#219;', '&#220;', '&#221;', '&#222;', '&#223;', '&#224;',
    '&#225;', '&#226;', '&#227;', '&#228;', '&#229;', '&#230;',
    '&#231;', '&#232;', '&#233;', '&#234;', '&#235;', '&#236;',
    '&#237;', '&#238;', '&#239;', '&#240;', '&#241;', '&#242;',
    '&#243;', '&#244;', '&#245;', '&#246;', '&#248;', '&#249;',
    '&#250;', '&#251;', '&#252;', '&#253;', '&#254;', '&#255;',
    '&#338;', '&#339;', '&#352;', '&#353;', '&#376;', '&#710;',
    '&#732;', '&#8194;','&#8195;','&#8201;','&#8204;','&#8205;',
    '&#8206;','&#8207;','&#8211;','&#8212;','&#8216;','&#8217;',
    '&#8218;','&#8220;','&#8221;','&#8222;','&#8224;','&#8225;',
    '&#8230;','&#8240;','&#8249;','&#8250;','&#8364;'
  );

  /**
   * Return all entities
   *
   * @return array
   */
  public static function all_entities ()
  {
    return self::$iso88591                    +
           self::$international               +
           self::$symbols                     +
           self::$greek;
  }

  /**
   * Return all entity keys
   *
   * @return array
   */
  public static function all_keys ()
  {
    return array_keys (self::$iso88591)        +
           array_keys (self::$international)   +
           array_keys (self::$symbols)         +
           array_keys (self::$greek);
  }

  /**
   * Return all entity values
   *
   * @return array
   */
  public static function all_values ()
  {
    return array_values (self::$iso88591)      +
           array_values (self::$international) +
           array_values (self::$symbols)       +
           array_values (self::$greek);
  }

  /**
   * Replace all HTML entities in $text with the XML counter parts
   * @param string $text
   * @return string
   */
  public static function replace_html ($text)
  {
    return str_replace (self::$html, self::$xml, $text);
  }
}

/**
 * Converts $text into safe XML text
 *
 * @param string $text
 * @return string
 */
function safe_xml ($text, $to_utf8=false)
{
  $out = '';
  $pos = 0;

  while(($pos = strpos ($text, '&')) !== false) {
    if (preg_match ('/^&([^ <>;&]+);/', substr ($text, $pos), $m)) {
      $out .= htmlspecialchars (substr ($text, 0, $pos), ENT_NOQUOTES) .
              "&{$m[1]};";
      $text = substr ($text, $pos+2+strlen ($m[1]));
      continue;
    }
    $out .= htmlspecialchars (substr ($text, 0, $pos+1));
    $text = substr ($text, $pos+1);
  }

  $out = Ent::replace_html ($out . htmlspecialchars ($text, ENT_NOQUOTES));
  return $to_utf8 ? utf8_encode ($out) : $out;
}
?>