# Contao: A/B Testing

[![Latest Stable Version](https://poser.pugx.org/bastibuck/contao-ab-testing/v/stable)](https://packagist.org/packages/bastibuck/contao-ab-testing)
[![Total Downloads](https://poser.pugx.org/bastibuck/contao-ab-testing/downloads)](https://packagist.org/packages/bastibuck/contao-ab-testing)
[![License](https://poser.pugx.org/bastibuck/contao-ab-testing/license)](https://packagist.org/packages/bastibuck/contao-ab-testing)

This extension provides a new page type to evenly distribute visitors within the selected pages. At the same time it makes sure that returning visitors will be redirected to the page they have visited before.

This way A/B tests can be performed in Contao Open Source CMS.

## Features
* Select one or more pages to be tested
* Set a cookie and its' expiring time
* adds new Content Element to set a PIWIK Custom Variable easily

## How does the extension work?
![A/B Testing visitor flow](../screens/AB-Test-Extension.jpg)

The visitor flow is visualized in the graphic above and shows how the extension works.

1. Visitor **a** is the first visitor to our A/B test. The A/B test page checks which test-page was last visited by any visitor. Since visitor **a** is the first visitor there will be no result and **a** will be redirected to the first of the test-pages **V0**.
2. Visitor **b** is the second visitor. Checking which page was visited before will now return the ID of test-page **V0**. Therefore visitor **b** will be redirected to the second test-page **V1**.
3. When visitor **c** visits our A/B test the check of the last visited page will return the ID of the second page **V1** since the last visitor was redirected to this one. Visitor **c** will therefore be redirected to test-page **V0** again as **V1** was the last page in the test.
4. Visitor **d** is a returning visitor. He visited the A/B test before and was redirected to **V0**. By this time a cookie was saved on his device containing the value of the test-page he visited. On the returning visit the A/B test checks if the cookie exists and if so gets its' value and redirects the visitor to the same page he has seen before. In this case this will also be **V0** although the next page to be visited would be **V1** again (if it wasn't a returning visitor). Additionally the last visited pge won't be saved in the case of returning visitors so the regular visitor order won't be messed up.
5. Visitor **e** is a first time visitor, has no cookie with a page ID value and therefore triggers the check of the last visited page which returns the ID of page **V0** (visitor **c** was the last one to visit it). Therefore visitor **e** will be redirected to test-page **V1**. 


## Notice
This extension doesn't provide analytics! To get insights on statistics of your visitors you will need to use an analytic software like Google Analytics, PIWIK or similar.
