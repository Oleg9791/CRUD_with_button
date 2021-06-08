<?php


namespace W1020\HTML;


class Pagination
{
    protected int $pageCount;
    protected int $activePage;
    protected int $page = 1;
    protected string $urlPrefix = "?page=";

    /**
     * @param int $pageCount
     * @return $this
     */
    public function setPageCount(int $pageCount)
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * @param int $activePage
     * @return $this
     */
    public function setActivePage(int $activePage)
    {
        $this->activePage = $activePage;
        return $this;
    }

    /**
     * @param string $urlPrefix
     * @return $this
     */
    public function setUrlPrefix(string $urlPrefix)
    {
        $this->urlPrefix = $urlPrefix;
        return $this;
    }

    public function getNextPage()
    {
        $nextUrl = $this->pageCount;

        if ($this->activePage + 1 <= $this->pageCount) {
            $nextUrl = $this->activePage + 1;
        }
        return $nextUrl;
    }

    public function getPreviousPage()
    {
        if ($this->activePage == 1) {
            $nextUrl = 1;

        } elseif ($this->activePage - 1 <= $this->activePage) {
            $nextUrl = $this->activePage - 1;
        }
        return $nextUrl;
    }


    public function html()
    {
        $html = <<<EOT
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="$this->urlPrefix{$this->getPreviousPage()}" tabindex="-1" aria-disabled="true">&laquo;</a>
    </li>
EOT;

        for ($i = 1; $i <= $this->pageCount; $i++) {
            $html .= "<li class='page-item" . ($i == $this->activePage ? " active" : "") .
                "'><a class='page-link' href='$this->urlPrefix$i'>$i</a></li>";

        }

        $html .= <<<EOT
    <li class="page-item">
      <a class="page-link" href="$this->urlPrefix{$this->getNextPage()}">&raquo;</a>
    </li>
  </ul>
</nav>
EOT;
        return $html;
    }

}