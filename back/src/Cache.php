<?php

namespace App;

class Cache
{
    private string $filename;
    private array $data;

    public function __construct(string $filename)
    {
        $this->setFile($filename);
    }

    public function getFile(): ?string
    {
        return $this->filename;
    }

    public function setFile(string $filename): ?string
    {
        $this->filename = 'cache/'.$filename;
        return $this->filename;
    }

    public function setData(array $tags,array $count): ?array
    {
        $this->data = ['tags'=>$tags,'count'=>$count];
        return $this->data;
    }

    public function writeFile(): void
    {
        $data = json_encode($this->data);
        file_put_contents($this->filename,$data);
    }

    public function readFile(): ?array
    {
        return json_decode(file_get_contents($this->filename),1);
    }

    public function clear(): bool
    {
        return unlink($this->filename);;
    }
}