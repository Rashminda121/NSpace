<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('../dbConfig.php');
$conn = dbCon();

$email = $_GET['email'];
$accept="accept";

// Retrieve data from the database
$sql = "SELECT * FROM landlorddata WHERE status=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $accept);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="navbar.js"></script>
        <title>Property Edit</title>
    </head>

    <body>
        <?php include("navbar.php"); ?>
        <?php
        
        $req = false;
        //get email
        if (isset($_GET['email'])) {

            $email = $_GET['email'];
        }

       ?>
        <h1 class=" text-2xl text-center m-5 text-blue-800 font-bold">View Properties</h1>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="flex justify-center p-10 place-content-center mb-10">

                <hr>
                <form action="" method="post"
                    enctype="multipart/form-data" class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6 text-left text-xl font-bold">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                ID:
                                <?php echo $row['id']; ?>
                                <?php $currentid = $row['id']; ?>
                            </label>
                        </div>

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                Title
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="title" name="title" type="text" placeholder="Title" value="<?php echo $row['title']; ?>"
                                <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>

                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bedroom">
                                Bedrooms
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="bedroom" name="bedrooms" type="number" placeholder="bedroom"
                                value="<?php echo $row['bedrooms']; ?>" <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bathroom">
                                Bathrooms
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="bathroom" name="bathroom" type="number" placeholder="bathroom"
                                value="<?php echo $row['bathrooms']; ?>" <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="land">
                                Land Size
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="land" type="text" placeholder="Size" name="land" value="<?php echo $row['landsize']; ?>"
                                <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="unit">
                                Unit
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="unit" name="unit" <?php echo $req ? 'required' : ''; ?> disabled>
                                    <?php if ($row['unit'] == 'perches') { ?>
                                        <option value="">Unit</option>
                                        <option value="perches" selected>Perches</option>
                                        <option value="acres">Acres</option>
                                    <?php } if ($row['unit'] == 'acres'){ ?>
                                        <option value="">Unit</option>
                                        <option value="perches">Perches</option>
                                        <option value="acres" selected>Acres</option>
                                    <?php } ?>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                City
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="city" type="text" placeholder="City" name="city" value="<?php echo $row['city']; ?>"
                                <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                                State/ Province
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="state" type="text" placeholder="State" name="state"
                                value="<?php echo $row['state']; ?>" <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                                Zip
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="zip" type="text" placeholder="Code" name="zip" value="<?php echo $row['zipcode']; ?>"
                                <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                Address
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="address" type="text" placeholder="Address" name="address"
                                value="<?php echo $row['address']; ?>" <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" cols="50"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                placeholder="Description" name="description" <?php echo $req ? 'required' : ''; ?> disabled> <?php echo $row['description']; ?> </textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-3/5 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                                Price
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="price" type="text" placeholder="price" name="price"
                                value="<?php echo $row['price']; ?>" <?php echo $req ? 'required' : ''; ?> disabled>
                        </div>
                        <div class="w-full md:w-2/5 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="negotiable">
                                Negotiable
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="negotiable" name="negotiable" <?php echo $req ? 'required' : ''; ?> disabled> 
                                    <?php if ($row['negotiable']== 'Negotiable') { ?>
                                        <option selected>Negotiable</option>
                                        <option>Not Negotiable</option>
                                    <?php } else { ?>
                                        <option>Negotiable</option>
                                        <option selected>Not Negotiable</option>
                                    <?php } ?>


                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr><br>
                    <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-center">Image</p>
                    <!-- Display images -->
                  <div class="flex flex-wrap justify-center">
                     
                    <div class="w-full sm:w-2/5 px-2 mb-4 shadow-xl">
                        <img src="../uploads/<?php echo $row['image']; ?>" alt="Property Image" name="image" class="mx-auto w-full h-auto">
                    </div>
                </div>

                    
                    <hr><br>

                </form>

            </div>
            <?php
        }
        ?>
        <?php include("footer.php"); ?>

    </body>

    </html>




    <?php
} else {    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="navbar.js"></script>
        <title>Property Edit</title>
    </head>

    <body>
        <?php include("navbar.php"); ?>
        <div class="p-20">
            <h1 class=" text-2xl text-center m-5 text-blue-800 font-bold ">No Properties Available</h1>
        </div>
        <?php include("footer.php"); ?>
    </body>
    </html>
    

<?php 
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>