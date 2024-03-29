<?php 

namespace MyWebsite\Model\Contact;

require_once('src/lib/database.php');

use MyWebsite\Lib\Database\DatabaseConnection;

class Contact
{
	public string $lastname;
	public string $firstname;
	public string $email;
	public string $content;
	public string $creationDate;
}

/**
 * 
 * class that contains methods for the contact action
 */
class ContactRepository 
{
	public DatabaseConnection $connection;

	/**
	 * function to post the contact request
	 * 
	 * @param string $lastname
	 * @param string $firstname 
	 * @param string $email
	 * @param string content
	 * 
	 */
	public function contactPost(string $lastname, string $firstname, string $email, string $content): bool
	{
		$statement = $this->connection->getConnection()->prepare(
			'INSERT INTO contact(lastname, firstname, email, content, creationDate) VALUES (?, ?, ?, ?, NOW())'
		);
		
		$affectedLines = $statement->execute([$lastname, $firstname, $email, $content]);

		return ($affectedLines > 0);
	}

	/**
	 * function to send an email from the contact request
	 * 
	 * @param string $lastname
	 * @param string $firstname 
	 * @param string $email
	 * @param string content
	 * 
	 */
	public function sendMail(string $lastname, string $firstname, string $email, string $content): void 
	{
		$to = "coline.llopez@gmail.com";
		$name = $lastname . " " . $firstname;
		$subject = "Vous avez reçu un mail à partir de votre formulaire de contact";
		$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $content;
		$headers = "From: noreply@yoursite.com" . "\r\n" ;
		if($email!=NULL){
		    mail($to,$subject,$txt,$headers);
		}
	}
}
