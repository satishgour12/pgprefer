<?php
require 'config.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM register WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>PG Prefer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header> 
        <?php include 'header.php'; ?>
    </header>

    <div class="hero">
        <div class="text-box">
            <h1>PG Prefer</h1>
            <div class="search">
                <!-- <input type="text" name="" placeholder="Search PG" class="search-input" id="search-item">
                <div class="search-icon">
                    <i class="fa-solid fa-microphone"  onclick="record()"></i>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div> -->
                <form action="search.php" method="post">
                <div class="search-container">
                    <input type="text" name="h_location" id="search-input" placeholder="Search by location...">
                    <select name="h_type" id="gender-filter">
                        <option value="all">Gender</option>
                        <option value="boys">Boys</option>
                        <option value="girls">Girls</option>
                    </select>
                    <!-- <select name="h_price" id="price-filter">
                        <option value="all">Price</option>
                        <option value="2000-3000">2000-3000</option>
                        <option value="3000-4000">3000-4000</option>
                        <option value="4000-5000">4000-5000</option>
                    </select> -->
                    <button name="h_search" id="search-button">Search</button>
                </div>
                <h2>or Search by College Name</h2>
                </form>
                
            </div>
            
            <form action="search.php" method="post">
                
                <div class="form">
                <input name="h_college" id="input" type="search" placeholder="Search here ...">
                    <button class="icon" name="h_college_search"><i  class="fa fa-search"></i></button>
                </div>
                <div id="form-action">
                    <div class="result-box">
                        
                    </div>
                    </div>
            </form>
            <h3>Your perfect room is just a click away; <br>
                discover a life that resonates with you.</h3>
        </div>
    </div>

    <section class="featured">
    <div class="content">
        <p>Featured PGs</p>
    </div>

    <div class="pg-section" id="pg-list">
    <?php
    $select_properties = $conn->prepare("SELECT * FROM post_pg ORDER BY date DESC LIMIT 10");
    $select_properties->execute();
    $result_properties = $select_properties->get_result();
    if($result_properties->num_rows > 0) {
        while($fetch_property = $result_properties->fetch_assoc()) {
            $post_id = $fetch_property['pg_id'];

            $count_reviews = $conn->prepare("SELECT * FROM reviews WHERE post_id = ?");
            $count_reviews->bind_param("i",$post_id);
            $count_reviews->execute();
            $count_reviews->store_result();
            $total_reviews = $count_reviews->num_rows();
?>

        <div class="box">
            <div class="box-content container">
                <a href="./readmore.php?get_id=<?= $fetch_property['pg_id']; ?>" class="h3"><?php echo $fetch_property['pg_name'];?></a>
                <p class="addr"><i class="fa-solid fa-location-dot"></i><?php echo $fetch_property['pg_address'];?></p>
                <div class="card">
                    <div class="face face1"
                    style="background: url('pg-image/<?php echo $fetch_property['image_01'];?>'); background-size: cover">
                    </div>

                    <div class="face face2">
                        <div class="face-content">
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <span>(<?= $total_reviews; ?> reviews)</span>
                            </div>
                            <p><i class="fa-solid fa-bed"></i><?php echo $fetch_property['available_rooms'];?> rooms available</p>

                            <a href="./readmore.php?get_id=<?= $fetch_property['pg_id']; ?>" type="button">Read More</a>
                        </div>
                    </div>
                </div>


                <div class="box-details">
                    <div class="rs-icon">
                        <p>
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <?php echo $fetch_property['price'];?>
                        </p>
                    </div>
                    <div class="gender">
                    <?php echo $fetch_property['gender'];?>
                        <i class="fa-solid fa-person"></i>
                    </div>
                </div>
            </div>
        </div>
                <?php
                
            }
        }
        else{
            echo "NO PG added";
        }

        ?>
         

        
    </div>
    </section>
    <!-- About Section -->

    <div id="about-us">

        <div class="about-section">
            <h1>About Us</h1>
            <p>Welcome to our rental PG website, where comfort meets convenience. We understand the significance of
                finding
                the perfect accommodation, especially when away from home. Our platform is designed to simplify your
                search,
                offering a diverse range of premium paying guest accommodations tailored to your needs. Whether you're a
                student, a working professional, or someone seeking a cozy place to call home temporarily, we strive to
                match you with spaces that resonate with your lifestyle. With a commitment to quality, safety, and
                seamless
                experiences, we take pride in being your trusted partner in finding the ideal PG accommodation. Join us
                on
                this journey as we redefine the way you experience comfort away from home.</p>
        </div>

        <!-- <h2 style="text-align:center">Our Team</h2>

        <div class="row">

            <div class="column">
                <div class="card-info">
                    <img src="./ajay.jpg" alt="Ajay">
                    <div class="contain">
                        <h2>Ajay singha</h2>
                        <p class="title">Full-Stack Developer & Designer</p>
                        
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card-info">
                    <img src="./satish.jpg" alt=" Satish gour">
                    <div class="contain">
                        <h2>Satish Gour</h2>
                        <p class="title">Full-Stack Developer</p>
                        
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card-info">
                    <img src="./keny.jpg" alt="Keny Sinha" >
                    <div class="contain">
                        <h2>Keny sinha</h2>
                        <p class="title">Frontend-Developer</p>
                        
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card-info">
                    <img src="./suman.jpg" alt="Suman nath">
                    <div class="contain">
                        <h2>Suman nath</h2>
                        <p class="title">Database Designer</p>
                        
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card-info">
                    <img src="./vishal.jpg" alt="Bishal chanda" >
                    <div class="contain">
                        <h2>Vishal chanda</h2>
                        <p class="title">Frontend-Developer</p>
                        
                    </div>
                </div>
            </div>

        </div> -->

    </div>

    <footer>
        <?php include 'footer.php';
        ?>
    </footer>





    <script src="index.js">

    </script>
</body>

</html>