<div class="content-wrapper" style="min-height: 600px;">
    <div class="container">
        <div class="row">

            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6">
                <div class="panel panel-default" style="margin-top:60px;">
                    <div class="panel-heading"><div class="panel-title">Login</div></div>
                    <div class="panel-body">                        
                        <form name="LoginForm" method="post" action="/newadv/Login/validateUser">
                            <!--- error --->
                            <!--- text --->
                            <div class="form-group">
                                <label for="fUserID">User ID (email)</label>
                                <input type="text" class="form-control" id="Email" name="Email" placeholder="User ID (email)">
                            </div>
                            <!--- password --->
                            <div class="form-group">
                                <label for="fPassword">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary pull-right">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">&nbsp;</div>
        </div> <!--- row --->
    </div> <!--- container --->
</div>