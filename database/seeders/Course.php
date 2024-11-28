<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Course extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('courses')->insert([
            'CourseID' => 'FLA001',
            'CourseName' => 'Framework Architecture Layer1',
            'CourseDescription' => 'This course explores the foundational concepts of software architecture and frameworks, focusing on building scalable and maintainable software structures. Students will learn about design patterns, layer separation, and the role of frameworks in software development.',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'CourseID' => 'WEB001',
            'CourseName' => 'Advanced Web Development',
            'CourseDescription' => 'In this course, students will delve into modern web development technologies and techniques. Topics include responsive web design, advanced JavaScript frameworks, server-side programming, and API development, with an emphasis on best practices and performance',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'CourseID' => 'DML001',
            'CourseName' => 'Data Science and Machine Learning',
            'CourseDescription' => 'This course covers the principles and techniques of data science and machine learning. Students will gain hands-on experience with data analysis, visualization, and model building using Python and popular libraries like Pandas, NumPy, and Scikit-learn. The course also includes an introduction to deep learning and AI concepts.',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'CourseID' => 'MOB001',
            'CourseName' => 'Mobile App Development',
            'CourseDescription' => 'This course provides an introduction to mobile app development for iOS and Android platforms. Students will learn how to design, develop, and deploy mobile applications using native development tools and cross-platform frameworks, focusing on user experience and mobile interface design.',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'CourseID' => 'CYB001',
            'CourseName' => 'Cybersecurity Fundamentals',
            'CourseDescription' => 'This course introduces students to the basics of cybersecurity, covering topics such as network security, encryption, ethical hacking, and risk management. Students will learn how to protect systems from security threats and vulnerabilities and understand the importance of security in the digital world.',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'CourseID' => 'NET001',
            'CourseName' => 'Network Management',
            'CourseDescription' => 'This course focuses on the principles and practices of managing computer networks. Topics include network topology, IP addressing, routing and switching, network monitoring, and troubleshooting. Students will also gain experience with network administration tools and protocols.',
            'SKS' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
