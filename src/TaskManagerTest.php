<?php

namespace Kevin\TestsFonctionnels;

use PHPUnit\Framework\TestCase;

class TaskManagerTest extends TestCase
{
    private TaskManager $taskManager;

    protected function setUp(): void
    {
        $this->taskManager = new TaskManager();
    }

    public function testAddTask(): void
    {
        $this->taskManager->addTask("Tâche A");
        $tasks = $this->taskManager->getTasks();
        $this->assertCount(1, $tasks);
        $this->assertEquals("Tâche A", $tasks[0]);
    }

    public function testRemoveTask(): void
    {
        $this->taskManager->addTask("Tâche A");
        $this->taskManager->addTask("Tâche B");
        $this->taskManager->removeTask(0);
        $tasks = $this->taskManager->getTasks();
        $this->assertCount(1, $tasks);
        $this->assertEquals("Tâche B", $tasks[0]);
    }

    public function testGetTasks(): void
    {
        $this->taskManager->addTask("Tâche A");
        $this->taskManager->addTask("Tâche B");
        $tasks = $this->taskManager->getTasks();
        $this->assertEquals(["Tâche A", "Tâche B"], $tasks);
    }

    public function testGetTask(): void
    {
        $this->taskManager->addTask("Tâche unique");
        $this->assertEquals("Tâche unique", $this->taskManager->getTask(0));
    }

    public function testRemoveInvalidIndexThrowsException(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index invalide pour suppression");
        $this->taskManager->removeTask(999);
    }

    public function testGetInvalidIndexThrowsException(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index invalide pour récupération");
        $this->taskManager->getTask(999);
    }

    public function testTaskOrderAfterRemoval(): void
    {
        $this->taskManager->addTask("Tâche A");
        $this->taskManager->addTask("Tâche B");
        $this->taskManager->addTask("Tâche C");

        $this->taskManager->removeTask(1); // Suppression de la tache B

        $tasks = $this->taskManager->getTasks();
        $this->assertEquals(["Tâche A", "Tâche C"], $tasks);
    }
}
