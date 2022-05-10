<?php

/**
 * The data model for message related queries.
 */
class Message
{
    private $db;

    /**
     * On construction, create a database connection
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Insert message into the messages table.
     *
     * @param Array $data - The message to insert.
     * @return Boolean - True if found, false if not.
     */
    public function insertMessage($data)
    {
        $this->db->query('INSERT INTO messages (name, email, subject,message) VALUES(:name, :email, :subject,:message)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':message', $data['message']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all messages.
     *
     * @return Array - List of messages as objects.
     */
    public function getMessages()
    {
        $this->db->query('SELECT *, SUBSTRING(message, 1, 45) AS short_message 
                            FROM messages 
                            ORDER BY sent_date DESC');

        return $this->db->resultSet();
    }

    /**
     * Get limited number of messages.
     *
     * @param Int $limit - Number of messages to retrieve.
     * @return Array - List of messages as objects.
     */
    public function getLimitedMessages($limit)
    {
        $this->db->query('SELECT *, SUBSTRING(message, 1, 45) AS short_message FROM messages 
                            ORDER BY sent_date DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);

        return $this->db->resultSet();
    }

    /**
     * The number of messages that are unread.
     *
     * @return Int - The number of unread messages.
     */
    public function unreadMessageCount()
    {
        $this->db->query('SELECT COUNT(*) AS unread FROM messages 
                            WHERE opened = 0');

        return $this->db->single();
    }

    /**
     * Delete selected message
     *
     * @param Int $id - The message to delete.
     * @return Boolean - True if executed, false if not.
     */
    public function deleteMessage($id)
    {
        $this->db->query('DELETE FROM messages
                            WHERE id = :id');

        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get selected message
     *
     * @param Int $id - The message to retrieve.
     * @return Object if found, false if not.
     */
    public function getMessage($id)
    {
        $this->db->query('SELECT * FROM messages
                            WHERE id = :id');

        $this->db->bind(':id', $id);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Update the read status of the message.
     *
     * @param Int $id - The message to update.
     * @return Void
     */
    public function updateReadStatus($id)
    {
        $this->db->query('UPDATE messages 
                            SET opened = 1
                            WHERE id = :id');

        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
