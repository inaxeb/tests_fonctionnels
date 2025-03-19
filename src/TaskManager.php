<?php

namespace Kevin\TestsFonctionnels;

class TaskManager
{
    private array $tasks = [];

    public function addTask(string $task): void
    {
        $this->tasks[] = $task;
    }

    public function removeTask(int $index): void
    {
        if (!isset($this->tasks[$index])) {
            throw new \OutOfBoundsException("Index invalide pour suppression");
        }
        unset($this->tasks[$index]);
        $this->tasks = array_values($this->tasks);
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function getTask(int $index): string
    {
        if (!isset($this->tasks[$index])) {
            throw new \OutOfBoundsException("Index invalide pour récupération");
        }
        return $this->tasks[$index];
    }
}
