<?php

/**
 * Represents a page redirector.
 */
class PageRedirector
{
    /**
     * Redirects to the specified page.
     *
     * @param string $page The page to redirect to.
     */
    public function redirectToPage($page)
    {
        switch ($page) {
            case 'galaxy':
                $this->redirectTo("../front/galaxy.php");
                break;
            case 'infrastructure':
                $this->redirectTo("../front/infrastructure.php");
                break;
            case 'space-yard':
                $this->redirectTo("../front/space-yard.php");
                break;
            case 'research-lab':
                $this->redirectTo("../front/research-lab.php");
                break;
            case 'fleet':
                $this->redirectTo("../front/fleet.php");
                break;
            case 'admin':
                $this->redirectTo("../front/admin.php");
                break;
            default:
                $this->redirectTo("../front/portal.php");
                break;
        }
    }

    /**
     * Performs the actual redirect to the specified URL.
     *
     * @param string $url The URL to redirect to.
     */
    private function redirectTo($url)
    {
        header("Location: $url");
        exit();
    }
}

if (isset($_POST['page'])) {
    $page = $_POST['page'];
    $redirector = new PageRedirector();
    $redirector->redirectToPage($page);
}
