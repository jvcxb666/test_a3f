<?php

namespace App;

class Parser
{
    private string $url;
    private array $result;
    private array $tags;
    
    public function __construct(string $url)
    {
        $this->setUrl($url);
        $this->result = $this->parseUrl();
        $this->findTags();
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): ?string
    {
        if(strpos($url,'http://') == false || strpos($url,'https://') == false){
            $url = 'https://'.$url;
        }

        $this->url = $url;
        return $this->url;
    }

    private function parseUrl(): ?array
    {
        return file($this->url);
    }

    private function findTags(): array
    {
        foreach($this->result as $line){
            $line = trim(htmlspecialchars($line));
            if( strpos($line,htmlspecialchars('<')) !== false && strpos($line,htmlspecialchars('>')) !== false){
                $tags = explode(htmlspecialchars('<'),$line);
                foreach($tags as $tag){
                    if(!empty($tag) && strpos($tag,htmlspecialchars('>')) !== false){
                        $tag = str_replace(htmlspecialchars('>'),' ',$tag);
                        $tag = explode(' ',$tag)[0];
                        if(strpos($tag,'/') === false && strpos($tag,'!--') === false){
                            $this->tags[] = $tag;
                        }
                    }
                }
               
            }
        }
        return $this->tags;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function getCount(): ?array
    {
        return ['all'=>count($this->tags),'unique' => count(array_unique($this->tags))];
    }
}