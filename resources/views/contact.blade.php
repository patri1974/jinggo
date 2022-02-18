@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <style>
                
                input[type=text], select, textarea {
                  width: 100%;
                  padding: 12px;
                  border: 1px solid #ccc;
                  border-radius: 4px;
                  box-sizing: border-box;
                  margin-top: 6px;
                  margin-bottom: 16px;
                  resize: vertical;
                }
                
                input[type=submit] {
                  background-color: #04AA6D;
                  color: white;
                  padding: 12px 20px;
                  border: none;
                  border-radius: 4px;
                  cursor: pointer;
                }
                
                input[type=submit]:hover {
                  background-color: #45a049;
                }
                
                </style>
                
                <h3>Contact Form</h3>
                
                <div class="container">
                  <form action="#" method="get">
                      <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Email ...">
                        <small id="helpId" class="form-text text-muted">Plase input your E-Mail</small>
                      </div>
                      
                      <div class="form-group">
                        <label for="name">Name </label>
                        <input type="name" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Name ...">
                        <small id="helpId" class="form-text text-muted">Plase input your Name</small>
                      </div>
                
                    <label for="subject">Subject</label>
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                      <div class="text-right">
                          <input type="submit" value="Submit">
                      </div>
                  </form>
                </div>
                
                
                </div>
        </div>
    </div>
</div>
@endsection
