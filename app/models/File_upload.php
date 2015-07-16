<?php

Class File_upload extends Eloquent
{
	protected $table = 'file_uploads';
	protected $primaryKey = 'file_uploads_id';

	// Process file upload.
	public function upload_related_files($file_data, $ticket_id)
	{
		// Loop through each file and upload using the original name, into a directory named the user's ID.
		// Also add details into the files table after each upload.
		$user_id = Auth::id();

		foreach ($file_data as $file) 
		{
			// Upload file.
	        $destinationPath = 'public/uploads/' . $user_id;
	        $filename = $file->getClientOriginalName();
	        $mime_type = $file->getMimeType();
	        $extension = $file->getClientOriginalExtension();
	        $upload_success = $file->move(public_path('uploads/' . $user_id), $filename);

	        // Record details in Files table
	        $this->file_uploads_master_fk = $ticket_id;
	        $this->file_uploads_users_fk = $user_id;
	        $this->file_uploads_path = $destinationPath;
	        $this->file_uploads_name = $filename;

	     	$result = $this->save();

 			if (! $result)
			{
				return false;
			}

		}

		return true;
	}
	
}