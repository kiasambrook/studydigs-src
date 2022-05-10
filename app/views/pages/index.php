<?php require APPROOT . '/views/inc/header.php'; ?>
    <!-- Header items -->
    <header class="d-flex p-5 p-lg-0 pt-lg-5 text-center text-sm-start bg-primary">
        <div class="container d-sm-flex align-items-center justify-content-between">
            <div>
                <h1>Find your perfect<span class="text-light"> student property</span></h1>

                <p class="lead my-4">Use our search bar to search your student city and find your study digs.</p>

                <form class="input-group" method="POST" action="<?php echo URLROOT; ?>pages/search">
                    <select class="form-select" name="uni">
                        <optgroup label="Universities search">
                            <option value="na" selected hidden>Select City</option>
                            <?php foreach($data['universities'] as $university) : ?>
                                <option value="<?php echo $university->id;?>"><?php echo $university->name;?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>

                    <button type="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div>
                <img class="img-fluid d-none d-md-block" src="<?php echo URLROOT;?>img/house_search.svg" alt="image of a house with a magnifiying glass on top">
            </div>
        </div>
    </header>

    <!-- about the site -->
    <section id="about" class="bg-light text-dark p-5">
        <div class="container d-sm-flex align-items-center justify-content-center">
            <div class="d-flex">
                <img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT; ?>img/house_location.svg" alt="a row of houses with a purple location pin above">
            </div>
            <div id="about-us" class="text-md-start ms-4 text-center w-100">
                <h2>About us</h2>
                <p class="lead my-4">We are here to help you get your next student property sorted.&nbsp;</p>
                <p>As StudyDigs is a student-run project, we understands that organising student accommodation can be a particularly stressful time for many. Therefore, we have a designed a website to aid in the process and help students find their home away from home.</p>
                <p>Furthermore, StudyDigs makes it easy for landlords and estate agents to advertise their properties through their own personalised dashboard. <a href="<?php echo URLROOT; ?>users/register" class="link link-primary">Register with us</a> to get your properties out there.</p>
            </div>
        </div>
    </section>

    <!-- Website features -->
    <section id="features" class="bg-white text-dark p-5">
        <div class="container">
        <h2>Site Features</h2>
            <div class="row align-items-center justify-content-between g-4">
                <div class="card bg-light col-md">
                    <div class="card-body text-center">
                        <h1 class="h1 mb-3">
                            <i class="bi bi-house-door-fill"></i>
                        </h1>
                        <h3 class="card-title mb-3">Refine Searches</h3>
                        <p class="card-text">Use our site to search properties all across the UK. You are bound to find one for you!</p>
                    </div>
                </div>
                <div class="card bg-light col-md">
                    <div class="card-body text-center">
                        <h1 class="h1 mb-3">
                            <i class="bi bi-binoculars-fill"></i>
                        </h1>
                        <h3 class="card-title mb-3">Find Tenants</h3>
                        <p class="card-text">If you are a landlord or estate agent, upload your property today to begin finding new tenants.</p>
                    </div>
                </div>
                <div class="card bg-light col-md">
                    <div class="card-body text-center">
                        <h1 class="h1 mb-3">
                            <i class="bi bi-geo-alt-fill"></i>
                            </h1>
                        <h3 class="card-title mb-3">Discover Properties</h3>
                        <p class="card-text">Use the map feature to find properties that are close to your university and favourite locations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="bg-light p-5">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <p class="lead">Below are some of our most frequently asked questions, if you have any further questions do not hesitate to&nbsp;<a href="#contact">contact us</a>!</p>
            <h3 class="py-3">Students</h3>
            <div class="accordion accordion-flush" role="tablist" id="student-questions">
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#student-questions .item-1" aria-expanded="false" aria-controls="student-questions .item-1">Does my rental price include utility bills?</button></h2>
                    <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#student-questions">
                        <div class="accordion-body">
                            <p class="mb-0">Some properties include bills in their price, each property page will state whether the bills are included, available at an extra cost, or must be sorted by the tenant. You can filter your search to find properties that match your bill preferences on the search pages.&nbsp;</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#student-questions .item-2" aria-expanded="false" aria-controls="student-questions .item-2">How much is my deposit?</button></h2>
                    <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#student-questions">
                        <div class="accordion-body">
                            <p class="mb-0">The deposit will vary between properties which will be stated on the property page.&nbsp;<br><br>Important: Before handing over any money, please read the contract details carefully and ensure that your deposit is kept in a deposit protection scheme. A deposit protection scheme will help to ensure that your money is kept safe and will be returned to you at the end of your tenancy subject to contract terms.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#student-questions .item-3" aria-expanded="false" aria-controls="student-questions .item-3">How do I book a viewing?</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#student-questions">
                        <div class="accordion-body">
                            <p class="mb-0">When you find a property you like the look of, you can contact the agent using the contact details provided.&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="py-3">Agents</h3>
            <div class="accordion accordion-flush" role="tablist" id="agent-questions">
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#agent-questions .item-1" aria-expanded="false" aria-controls="agent-questions .item-1">I am a landlord, how do I advertise my properties?</button></h2>
                    <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#agent-questions">
                        <div class="accordion-body">
                            <p class="mb-0">Thanks for choosing StudyDigs for your business. You can begin advertising by creating a business account&nbsp;<a href="<?php echo URLROOT; ?>users/register">here</a>&nbsp;and follow the step by step forms to upload your first property!</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#agent-questions .item-2" aria-expanded="false" aria-controls="agent-questions .item-2">How much do you charge for your services?</button></h2>
                    <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#agent-questions">
                        <div class="accordion-body">
                            <p class="mb-0">Our services begin at one-time fee of £75 which will be need to payed before you can begin advertising your properties.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#agent-questions .item-3" aria-expanded="false" aria-controls="agent-questions .item-3">How do I book a viewing?</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#agent-questions">
                        <div class="accordion-body">
                            <p class="mb-0">When you find a property you like the look of, you can contact the agent using the contact details provided.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us -->
    <section id="contact" class="bg-white p-5">
        <div class="container">
        <?php echo flash('contact_message'); ?>
            <form action="<?php echo URLROOT; ?>pages/contact" method="POST" class="flex-column form-control text-center border-0 d-flex justify-content-center align-items-center" >
                <h2>Contact us</h2>
                <p class="lead">Use the form below to get in contact with us if you have enquiries or further questions.</p>
                <div class="input-group w-50 py-2">
                    <label class="form-label visually-hidden" for="name">Name:</label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['name']; ?>" placeholder="Name...">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="input-group w-50 py-2">
                    <label class="form-label visually-hidden" for="name">Email:</label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>" placeholder="Email...">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="input-group w-50 py-2">
                    <label class="form-label visually-hidden" for="subject">Subject:</label>
                    <input type="text" name="subject" class="form-control form-control-lg <?php echo (!empty($data['subject_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['subject']; ?>" placeholder="Subject...">
                    <span class="invalid-feedback"><?php echo $data['subject_err']; ?></span>
                </div>
                <div class="input-group w-50 py-2">
                    <label class="form-label visually-hidden" for="name">Message:</label>
                    <textarea placeholder="Message..." name="message" class="form-control form-control-lg <?php echo (!empty($data['message_err'])) ? 'is-invalid' : '';?>" > <?php echo $data['message']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['message_err']; ?></span>
                </div>
                <button class="btn btn-secondary" type="submit">Submit</button>
            </form>
        </div>
    </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
