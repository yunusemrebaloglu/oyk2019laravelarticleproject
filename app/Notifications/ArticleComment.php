<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Article;
use App\Comment;
use App\User;


class ArticleComment extends Notification implements ShouldQueue
{

	    use Queueable;

	protected $article;
	protected $comment;
	protected $user;
	    /**
	     * Create a new notification instance.
	     *
	     * @return void
	     */
	    public function __construct(User $user,Article $article, Comment $comment)
	    {
	        $this->article = $article;
	        $this->comment = $comment;
	        $this->user = $user;
	    }

	    /**
	     * Get the notification's delivery channels.
	     *
	     * @param  mixed  $notifiable
	     * @return array
	     */
	    public function via($notifiable)
	    {
	        return ['database'];
	    }

	    /**
	     * Get the mail representation of the notification.
	     *
	     * @param  mixed  $notifiable
	     * @return \Illuminate\Notifications\Messages\MailMessage
	     */
	    public function toMail($notifiable)
	    {
	        return (new MailMessage)
	                    ->line('The introduction to the notification.')
	                    ->action('Notification Action', url('/'))
	                    ->line('Thank you for using our application!');
	    }

	    /**
	     * Get the array representation of the notification.
	     *
	     * @param  mixed  $notifiable
	     * @return array
	     */
	    public function toArray($notifiable)
	    {
			// dd(12121);
			$return = [];
			$return['action'] = route('article.detail', $this->article);
			if ($this->comment->parent_id !== null) {

				$return['message'] = $this->article->title.' başlığındaki yzıya yapmış olduğunız yoruma'.$this->comment->user->name.'tarafından  yorum geldi';

			}else {
				$return['message'] = $this->article->title.'bu yazına yorum geldi'.$this->comment->user->name.'tarafından';
			}


			return $return;
	    }
	}
