<?php
$connection = new mysqli('localhost','root','','team');

// Handle delete request
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
	$delete_id = intval($_GET['delete']);
	$connection->query("DELETE FROM students WHERE id = $delete_id");
	// Optionally, redirect to avoid resubmission
	header('Location: devs.php');
	exit;
}

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student List</title>
	<style>
		body {
			font-family: 'Segoe UI', Arial, sans-serif;
			background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
			margin: 0;
			min-height: 100vh;
		}
		.container {
			max-width: 1100px;
			margin: 32px auto;
			background: #fff;
			padding: 32px 18px;
			border-radius: 16px;
			box-shadow: 0 8px 32px rgba(44,62,80,0.12);
		}
		h2 {
			text-align: center;
			color: #2d3e50;
			font-size: 2rem;
			font-weight: 600;
			margin-bottom: 24px;
		}
		a {
			display: inline-block;
			margin-bottom: 18px;
			color: #4CAF50;
			text-decoration: none;
			font-weight: 500;
			font-size: 1.1rem;
			transition: color 0.2s;
		}
		a:hover {
			color: #388e3c;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 12px;
			background: #f8fafc;
			border-radius: 8px;
			overflow: hidden;
		}
		th, td {
			border: 1px solid #bfc9d3;
			padding: 10px 8px;
			text-align: left;
			font-size: 1rem;
		}
		th {
			background: #e3eafc;
			color: #34495e;
			font-weight: 600;
		}
		tr:nth-child(even) {
			background: #f1f6fb;
		}
		img {
			border-radius: 6px;
			box-shadow: 0 2px 8px rgba(44,62,80,0.08);
		}
		@media (max-width: 800px) {
			.container {
				padding: 12px 2px;
			}
			table, th, td {
				font-size: 0.95rem;
			}
			h2 {
				font-size: 1.3rem;
			}
		}
		@media (max-width: 600px) {
			.container {
				padding: 6px 0;
			}
			table, th, td {
				font-size: 0.85rem;
				padding: 6px 2px;
			}
			th, td {
				min-width: 80px;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<a href="index.php">Add New Student</a>
	<h2>Student List</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Age</th>
			<th>Location</th>
			<th>Cell</th>
			<th>Gender</th>
			<th>Skill</th>
			<th>Photo</th>
			<th>Email</th>
			<th>Address</th>
			<th>Date of Birth</th>
			<th>Guardian</th>
			<th>Enrollment</th>
			<th>Action</th>
		</tr>
		<?php if($result && $result->num_rows > 0): ?>
			<?php while($row = $result->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo htmlspecialchars($row['name']); ?></td>
					<td><?php echo htmlspecialchars($row['age']); ?></td>
					<td><?php echo htmlspecialchars($row['location']); ?></td>
					<td><?php echo htmlspecialchars($row['cell']); ?></td>
					<td><?php echo htmlspecialchars($row['gender']); ?></td>
					<td><?php echo htmlspecialchars($row['skill']); ?></td>
					<td>
						<?php 
						$photo = $row['photo'];
						if(!empty($photo)) {
							if(preg_match('/^https?:\/\//', $photo)) {
								echo '<img src="' . htmlspecialchars($photo) . '" alt="Photo" style="max-width:60px;max-height:60px;">';
							} elseif(file_exists($photo)) {
								echo '<img src="' . htmlspecialchars($photo) . '" alt="Photo" style="max-width:60px;max-height:60px;">';
							} else {
								echo 'No image';
							}
						} else {
							echo 'No image';
						}
						?>
					</td>
					<td><?php echo htmlspecialchars($row['email']); ?></td>
					<td><?php echo htmlspecialchars($row['address']); ?></td>
					<td><?php echo htmlspecialchars($row['dob']); ?></td>
					<td><?php echo htmlspecialchars($row['guardian']); ?></td>
					<td><?php echo htmlspecialchars($row['enrollment']); ?></td>
					<td>
						<a href="devs.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');" style="color:#e74c3c;font-weight:600;">Delete</a>
					</td>
				</tr>
			<?php endwhile; ?>
		<?php else: ?>
			<tr><td colspan="14">No students found.</td></tr>
		<?php endif; ?>
	</table>
</div>
</body>
</html>
