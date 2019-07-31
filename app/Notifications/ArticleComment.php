<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Article;


class ArticleComment extends Notification implements ShouldQueue
{

	    use Queueable;

	protected $article;
	protected $user;
	protected $parent;
	    /**
	     * Create a new notification instance.
	     *
	     * @return void
	     */
	    public function __construct(Article $article, User $user, $parent = null)
	    {
	        $this->article = $article;
	        $this->user = $user;
	        $this->parent = $parent;
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
			$return = ['action' => route('article.detail', $this->article)];
			if ($this->parent != null) {

				$return['message'] = $this->article->title.' başlığındaki yzıya yapmış olduğunız yoruma'.$this->user->name.'tarafından  yorum geldi';

			}else {

				$return['message'] = $this->article->title.'bu yazına yorum geldi'.$this->user->name.'tarafından';
			}


			return $return;
	    }
	}
