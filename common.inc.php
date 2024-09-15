<?php
function email($email, $showlink=1) {
  // These are symbols that mean "@"
  $ats  = array('!@!', '!\&\#64\;!', '!\(at\)!', '! at !');
  // These are symbols that mean "."
  $dots = array('!\.!', '!\&\#46\;!', '!\(o\)!', '!\(dot\)!', '! dot\
 !');

  // The HTML link, utilizing javascript to obfuscate "@" and "."
  $link     = $email;
  $link_at  = "'+a+'";
  $link_dot = "'+d+'";
  $link     = preg_replace($ats, $link_at, $link);
  $link     = preg_replace($dots, $link_dot, $link);

  // The link text, which should be plain-text
  $disp     = $email;
  $disp_at  = '(at)';        // What should "@" be printed to?
  $disp_dot = '(dot)';    // What should "." be printed as?
  $disp     = preg_replace($ats, $disp_at, $disp);
  $disp     = preg_replace($dots, $disp_dot, $disp);

  // Return javascript code to print an email link
  if ($showlink) {
        return "<script type=\"text/javascript\" >
	<!--
        /* Javascript code to print out spam-proof email address */
        a = unescape(\"%40\");
        d = unescape(\"%2e\");
        document.write('<a href=\"mailto:$link\">$disp</a>');
	//-->
        </script>";
  }

  // If no HTML/Javascript is wanted, sipmly return the text
  return "$disp";
}
?>
